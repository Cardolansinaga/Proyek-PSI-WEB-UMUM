<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class GalleryController extends AdminController
{
    public function index()
    {
        return view('pages.admin.galeri', [
            'galleries' => Gallery::query()->orderBy('sort_order')->paginate(12),
        ]);
    }

    public function store(Request $request)
    {
        Gallery::create($this->validatedData($request));
        $this->clearPublicCache();

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil disimpan.');
    }

    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update($this->validatedData($request, $gallery->image_path));
        $this->clearPublicCache();

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery)
    {
        $this->images->delete($gallery->image_path);
        $gallery->delete();
        $this->clearPublicCache();

        return redirect()->route('admin.galeri')->with('status', 'Galeri berhasil dihapus.');
    }

    private function validatedData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'description' => ['nullable', 'string'],
            'image_class' => ['required', 'string', 'max:80'],
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'image' => [
                Rule::requiredIf(fn () => $request->input('status') === 'published' && (! $oldImage || $request->boolean('remove_image'))),
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:4096',
            ],
            'remove_image' => ['nullable'],
        ], [
            'image.required' => 'Tambahkan gambar sebelum memilih status Tampil di Website.',
            'image.image' => 'File galeri harus berupa gambar yang valid.',
            'image.mimes' => 'Gambar galeri harus berformat JPG, PNG, atau WebP.',
            'image.max' => 'Ukuran gambar galeri maksimal 4 MB.',
        ]);
        $data['image_class'] = trim($data['image_class']);
        $data['image_path'] = $this->updateImage($request, 'image', $oldImage);
        unset($data['image'], $data['remove_image']);

        return $data;
    }
}
