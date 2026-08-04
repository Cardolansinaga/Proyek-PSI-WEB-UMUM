<?php

namespace App\Http\Controllers\Admin;

use App\Models\PpdbApplication;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PpdbController extends AdminController
{
    public function index()
    {
        return view('pages.admin.ppdb', [
            'applications' => PpdbApplication::query()->latest()->paginate(20),
            'settings' => cache()->remember('admin_site_settings', 3600, fn () => SiteSetting::map(SiteSetting::defaults())),
        ]);
    }

    public function show(PpdbApplication $application)
    {
        return view('pages.admin.detail-ppdb', compact('application'));
    }

    public function verify(Request $request, PpdbApplication $application)
    {
        $data = $request->validate(['status' => ['required', 'in:waiting,verified,revision,rejected']]);
        $application->update($data);

        return redirect()->route('admin.ppdb')->with('status', 'Status pendaftar PPDB berhasil diperbarui.');
    }
}
