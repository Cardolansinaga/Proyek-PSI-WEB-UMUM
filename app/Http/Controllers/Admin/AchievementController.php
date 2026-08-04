<?php

namespace App\Http\Controllers\Admin;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AchievementController extends AdminController
{
    public function index()
    {
        return view('pages.admin.prestasi', [
            'achievements' => Achievement::query()->orderByDesc('year')->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('pages.admin.tambah-prestasi', [
            'achievement' => new Achievement(['year' => now()->year, 'level' => 'Nasional', 'status' => 'published']),
            'mode' => 'create',
        ]);
    }

    public function edit(Achievement $achievement)
    {
        return view('pages.admin.tambah-prestasi', compact('achievement') + ['mode' => 'edit']);
    }

    public function store(Request $request)
    {
        Achievement::create($this->validatedData($request));
        $this->clearPublicCache();

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil disimpan ke database dan halaman publik.');
    }

    public function update(Request $request, Achievement $achievement)
    {
        $achievement->update($this->validatedData($request, $achievement->image_path));
        $this->clearPublicCache();

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Achievement $achievement)
    {
        $this->images->delete($achievement->image_path);
        $achievement->delete();
        $this->clearPublicCache();

        return redirect()->route('prestasi.index')->with('status', 'Prestasi berhasil dihapus.');
    }

    private function validatedData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'student_name' => ['nullable', 'string', 'max:160'],
            'class_name' => ['nullable', 'string', 'max:120'],
            'competition' => ['nullable', 'string', 'max:160'],
            'level' => ['required', 'string', 'max:80'],
            'rank' => ['nullable', 'string', 'max:120'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string'],
            'image_class' => ['nullable', 'string', 'max:80'],
            'status' => ['required', Rule::in(['published', 'draft', 'archived'])],
            'is_featured' => ['nullable'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['image_path'] = $this->updateImage($request, 'image', $oldImage);
        unset($data['image'], $data['remove_image']);

        return $data;
    }
}
