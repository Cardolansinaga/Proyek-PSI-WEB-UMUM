<?php

namespace App\Http\Requests\Admin;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        /** @var Post|null $post */
        $post = $this->route('post');

        return [
            'title' => ['required', 'string', 'max:180'],
            'slug' => [
                'required',
                'string',
                'max:200',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('posts', 'slug')->ignore($post?->id),
            ],
            'category' => ['required', 'string', 'max:80'],
            'excerpt' => ['required', 'string', 'max:500'],
            'body' => ['required', 'string', 'max:50000'],
            'meta_title' => ['nullable', 'string', 'max:70'],
            'meta_description' => ['nullable', 'string', 'max:180'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
            'is_featured' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:999999'],
            'image_class' => ['nullable', 'string', 'max:80'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'slug.regex' => 'Slug hanya boleh berisi huruf kecil, angka, dan tanda hubung.',
            'slug.unique' => 'Slug sudah digunakan berita lain.',
            'image.mimes' => 'Gambar berita harus berformat JPG, PNG, atau WEBP.',
            'image.max' => 'Ukuran gambar berita maksimal 4 MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $title = trim((string) $this->input('title'));
        $requestedSlug = Str::slug((string) $this->input('slug'));

        $this->merge([
            'title' => $title,
            'slug' => $requestedSlug !== '' ? $requestedSlug : $this->uniqueSlug($title),
            'category' => trim((string) $this->input('category')),
            'excerpt' => trim((string) $this->input('excerpt')),
            'body' => trim((string) $this->input('body')),
            'meta_title' => $this->filled('meta_title')
                ? trim((string) $this->input('meta_title'))
                : null,
            'meta_description' => $this->filled('meta_description')
                ? trim((string) $this->input('meta_description'))
                : null,
            'is_featured' => $this->boolean('is_featured'),
            'remove_image' => $this->boolean('remove_image'),
        ]);
    }

    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title) ?: 'berita';
        $candidate = $base;
        $suffix = 2;
        /** @var Post|null $current */
        $current = $this->route('post');

        while (
            Post::withTrashed()
                ->where('slug', $candidate)
                ->when($current, fn ($query) => $query->whereKeyNot($current->getKey()))
                ->exists()
        ) {
            $candidate = $base.'-'.$suffix;
            $suffix++;
        }

        return $candidate;
    }
}
