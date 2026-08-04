<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ActivityController extends AdminController
{
    public function index()
    {
        return view('pages.admin.kesiswaan', [
            'activities' => Activity::query()->orderBy('sort_order')->paginate(15),
        ]);
    }

    public function create()
    {
        return view('pages.admin.form-kesiswaan', [
            'activity' => new Activity(['status' => 'Aktif', 'is_published' => true]),
            'mode' => 'create',
        ]);
    }

    public function edit(Activity $activity)
    {
        return view('pages.admin.form-kesiswaan', compact('activity') + ['mode' => 'edit']);
    }

    public function store(Request $request)
    {
        Activity::create($this->validatedData($request));
        $this->clearPublicCache();

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil disimpan ke database.');
    }

    public function update(Request $request, Activity $activity)
    {
        $activity->update($this->validatedData($request, $activity->image_path));
        $this->clearPublicCache();

        return redirect()->route('admin.kesiswaan.index')->with('status', 'Data kesiswaan berhasil diperbarui.');
    }

    private function validatedData(Request $request, ?string $oldImage = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'type' => ['required', 'string', 'max:120'],
            'coordinator' => ['nullable', 'string', 'max:120'],
            'mentor' => ['nullable', 'string', 'max:120'],
            'schedule' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:120'],
            'description' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['Aktif', 'Draft', 'Arsip'])],
            'publish' => ['required', Rule::in(['Ya, tampilkan', 'Tidak, simpan internal'])],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'remove_image' => ['nullable'],
        ]);

        $data['is_published'] = $data['publish'] === 'Ya, tampilkan';
        $data['image_class'] = Str::contains($data['type'], 'Organisasi') ? 'bi-people-fill' : 'bi-stars';
        $data['image_path'] = $this->updateImage($request, 'image', $oldImage);
        unset($data['publish'], $data['image'], $data['remove_image']);

        return $data;
    }
}
