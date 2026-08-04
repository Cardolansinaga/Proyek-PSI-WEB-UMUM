<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SiteImageService;
use Illuminate\Http\Request;

abstract class AdminController extends Controller
{
    public function __construct(protected SiteImageService $images) {}

    protected function updateImage(Request $request, string $field, ?string $oldPath = null): ?string
    {
        return $this->images->replace(
            $request->file($field),
            $oldPath,
            $request->boolean('remove_'.$field),
        );
    }

    protected function clearPublicCache(): void
    {
        cache()->forget('site_settings');
        cache()->forget('admin_site_settings');

        foreach (glob(public_path('page-cache/*.html')) ?: [] as $cacheFile) {
            if (is_file($cacheFile)) {
                @unlink($cacheFile);
            }
        }
    }
}
