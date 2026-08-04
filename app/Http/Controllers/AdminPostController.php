<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PostRequest;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Services\SiteImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class AdminPostController extends Controller
{
    private const DEFAULT_CATEGORIES = [
        'Berita',
        'Pengumuman',
        'Prestasi',
        'PPDB',
        'Akademik',
        'Kesiswaan',
    ];

    public function __construct(private readonly SiteImageService $images)
    {
    }

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:120'],
            'status' => ['nullable', Rule::in(['all', 'draft', 'published', 'scheduled', 'archived', 'trashed'])],
            'category' => ['nullable', 'string', 'max:80'],
            'sort' => ['nullable', Rule::in(['newest', 'oldest', 'title', 'updated'])],
        ]);

        $status = $filters['status'] ?? 'all';
        $sort = $filters['sort'] ?? 'newest';
        $query = $status === 'trashed'
            ? Post::query()->onlyTrashed()
            : Post::query();

        $query
            ->when($filters['search'] ?? null, function ($query, string $search): void {
                $query->where(function ($query) use ($search): void {
                    $query
                        ->where('title', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%')
                        ->orWhere('body', 'like', '%'.$search.'%');
                });
            })
            ->when($filters['category'] ?? null, fn ($query, string $category) => $query->where('category', $category));

        match ($status) {
            'draft' => $query->where('status', 'draft'),
            'published' => $query
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('published_at', '<=', now()),
            'scheduled' => $query
                ->where('status', 'published')
                ->where('published_at', '>', now()),
            'archived' => $query->where('status', 'archived'),
            default => null,
        };

        match ($sort) {
            'oldest' => $query->orderBy('published_at')->orderBy('id'),
            'title' => $query->orderBy('title')->orderByDesc('id'),
            'updated' => $query->latest('updated_at'),
            default => $query->orderByDesc('published_at')->latest('id'),
        };

        return view('pages.admin.posts.index', [
            'posts' => $query->paginate(15)->withQueryString(),
            'categories' => $this->categories(),
            'filters' => [
                'search' => $filters['search'] ?? '',
                'status' => $status,
                'category' => $filters['category'] ?? '',
                'sort' => $sort,
            ],
        ]);
    }

    public function create(): View
    {
        return view('pages.admin.posts.form', [
            'post' => new Post([
                'category' => 'Berita',
                'status' => 'draft',
                'published_at' => now(),
                'sort_order' => 0,
            ]),
            'categories' => $this->categories(),
            'mode' => 'create',
        ]);
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $data = $this->postData($request);
        $storedImage = null;

        try {
            if ($request->hasFile('image')) {
                $storedImage = $this->images->store($request->file('image'));
                $data['image_path'] = $storedImage;
            }

            $post = DB::transaction(function () use ($data): Post {
                if ($data['is_featured']) {
                    Post::query()->update(['is_featured' => false]);
                }

                return Post::query()->create($data);
            });
        } catch (Throwable $exception) {
            $this->images->delete($storedImage);
            throw $exception;
        }

        $this->clearPublicPageCache();

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('status', 'Berita berhasil disimpan.');
    }

    public function edit(Post $post): View
    {
        return view('pages.admin.posts.form', [
            'post' => $post,
            'categories' => $this->categories(),
            'mode' => 'edit',
        ]);
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $data = $this->postData($request);
        $oldImage = $post->image_path;
        $newImage = $oldImage;

        if ($request->hasFile('image')) {
            $newImage = $this->images->store($request->file('image'));
        } elseif ($request->boolean('remove_image')) {
            $newImage = null;
        }

        $data['image_path'] = $newImage;

        try {
            DB::transaction(function () use ($data, $post): void {
                if ($data['is_featured']) {
                    Post::query()->whereKeyNot($post->getKey())->update(['is_featured' => false]);
                }

                $post->update($data);
            });
        } catch (Throwable $exception) {
            if ($newImage !== $oldImage) {
                $this->images->delete($newImage);
            }

            throw $exception;
        }

        if ($newImage !== $oldImage) {
            $this->images->delete($oldImage);
        }

        $this->clearPublicPageCache();

        return redirect()
            ->route('admin.posts.edit', $post)
            ->with('status', 'Perubahan berita berhasil disimpan.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        $this->clearPublicPageCache();

        return redirect()
            ->route('admin.posts.index')
            ->with('status', 'Berita dipindahkan ke arsip sampah dan dapat dipulihkan.');
    }

    public function restore(int $post): RedirectResponse
    {
        $trashedPost = Post::onlyTrashed()->findOrFail($post);
        $trashedPost->restore();
        $this->clearPublicPageCache();

        return back()->with('status', 'Berita berhasil dipulihkan.');
    }

    public function forceDelete(int $post): RedirectResponse
    {
        $trashedPost = Post::onlyTrashed()->findOrFail($post);
        $imagePath = $trashedPost->image_path;
        $trashedPost->forceDelete();
        $this->images->delete($imagePath);
        $this->clearPublicPageCache();

        return back()->with('status', 'Berita dihapus permanen.');
    }

    public function preview(Post $post): View
    {
        return view('pages.umum.berita-detail', [
            'settings' => SiteSetting::map(SiteSetting::defaults()),
            'post' => $post,
            'relatedPosts' => Post::query()
                ->published()
                ->whereKeyNot($post->getKey())
                ->latest('published_at')
                ->take(3)
                ->get(),
            'isPreview' => true,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function postData(PostRequest $request): array
    {
        $data = $request->safe()->except(['image', 'remove_image']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        } elseif (! empty($data['published_at'])) {
            $data['published_at'] = Carbon::parse($data['published_at']);
        }

        return $data;
    }

    /**
     * @return array<int, string>
     */
    private function categories(): array
    {
        return collect(self::DEFAULT_CATEGORIES)
            ->merge(Post::withTrashed()->distinct()->orderBy('category')->pluck('category'))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function clearPublicPageCache(): void
    {
        foreach (glob(public_path('page-cache/*.html')) ?: [] as $cacheFile) {
            if (is_file($cacheFile)) {
                @unlink($cacheFile);
            }
        }
    }
}
