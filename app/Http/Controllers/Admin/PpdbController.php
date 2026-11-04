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

        $labels = ['waiting' => 'Menunggu', 'verified' => 'Terverifikasi', 'revision' => 'Perlu revisi', 'rejected' => 'Ditolak'];

        return redirect()->route('admin.ppdb.show', $application)->with('status', 'Status pendaftar diperbarui menjadi: '.$labels[$data['status']].'.');
    }
}
