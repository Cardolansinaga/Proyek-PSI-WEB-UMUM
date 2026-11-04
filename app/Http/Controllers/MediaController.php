<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MediaController extends Controller
{
    public function show(string $path): StreamedResponse
    {
        $safePath = str_replace('\\', '/', $path);
        abort_if(str_starts_with($safePath, '/') || preg_match('#(^|/)\.\.(/|$)#', $safePath), 404);
        abort_unless(Storage::disk('public')->exists($safePath), 404);

        return Storage::disk('public')->response($safePath, null, [
            'Cache-Control' => 'public, max-age=31536000, immutable',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
