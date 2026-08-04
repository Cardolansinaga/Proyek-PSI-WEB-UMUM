<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SiteImageService
{
    public function store(UploadedFile $file): string
    {
        return $file->store('site-images', 'public');
    }

    public function replace(?UploadedFile $file, ?string $oldPath = null, bool $remove = false): ?string
    {
        if ($remove) {
            $this->delete($oldPath);

            return null;
        }

        if (! $file) {
            return $oldPath;
        }

        $path = $this->store($file);
        $this->delete($oldPath);

        return $path;
    }

    public function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
