<?php

if (! function_exists('media_url')) {
    function media_url(?string $path): string
    {
        return $path ? route('media.show', ['path' => ltrim(str_replace('\\', '/', $path), '/')]) : '';
    }
}
