<?php

$publicPath = getcwd();
$publicRoot = realpath($publicPath) ?: $publicPath;

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY) ?? '';
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

send_security_headers();

if ($uri !== '/') {
    $staticPath = realpath($publicPath.$uri);

    if ($staticPath !== false && str_starts_with($staticPath, $publicRoot) && is_file($staticPath)) {
        serve_static_file($staticPath, $uri);

        return true;
    }
}

$cacheablePage = $method === 'GET' && $query === '' && is_public_cacheable_page($uri);
$cacheFile = $cacheablePage ? public_cache_file($publicPath, $uri) : null;

if ($cacheFile && is_file($cacheFile) && public_cache_is_fresh($cacheFile, $publicPath)) {
    serve_body(file_get_contents($cacheFile) ?: '', 'text/html; charset=UTF-8', 'public, max-age=300, stale-while-revalidate=60');

    return true;
}

if ($cacheFile && is_file($cacheFile)) {
    @unlink($cacheFile);
}

$formattedDateTime = date('D M j H:i:s Y');
$requestMethod = $_SERVER['REQUEST_METHOD'];
$remoteAddress = ($_SERVER['REMOTE_ADDR'] ?? '127.0.0.1').':'.($_SERVER['REMOTE_PORT'] ?? '0');

file_put_contents('php://stdout', "[$formattedDateTime] $remoteAddress [$requestMethod] URI: $uri\n");

handle_laravel_request($publicPath, $cacheablePage ? $cacheFile : null);

return true;

function handle_laravel_request(string $publicPath, ?string $cacheFile): void
{
    define('LARAVEL_START', microtime(true));

    if (file_exists($maintenance = $publicPath.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    require $publicPath.'/../vendor/autoload.php';

    $app = require_once $publicPath.'/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $request = Illuminate\Http\Request::capture();
    $response = $kernel->handle($request);
    $content = method_exists($response, 'getContent') ? (string) $response->getContent() : '';

    if ($cacheFile && $response->getStatusCode() < 400 && str_contains($content, '<!DOCTYPE html')) {
        $content = normalize_local_origin($content, $request->getSchemeAndHttpHost());
        $cacheDir = dirname($cacheFile);
        if (! is_dir($cacheDir)) {
            @mkdir($cacheDir, 0777, true);
        }

        @file_put_contents($cacheFile, $content, LOCK_EX);
    }

    $response->send();
    $kernel->terminate($request, $response);
}

function normalize_local_origin(string $content, string $origin): string
{
    return str_replace([$origin.'/', $origin], ['/', '/'], $content);
}

function is_public_cacheable_page(string $uri): bool
{
    if (in_array($uri, ['/', '/akademik', '/kesiswaan-ekstrakurikuler', '/ppdb', '/berita'], true)) {
        return true;
    }

    return (bool) preg_match('#^/berita/[^/]+$#', $uri);
}

function public_cache_file(string $publicPath, string $uri): string
{
    $key = $uri === '/' ? 'home' : trim(str_replace(['/', '\\'], '-', $uri), '-');

    return $publicPath.'/page-cache/'.$key.'.html';
}

function public_cache_is_fresh(string $cacheFile, string $publicPath): bool
{
    $cacheMtime = filemtime($cacheFile);
    $freshnessSources = [
        $publicPath.'/build/manifest.json',
        $publicPath.'/../server.php',
    ];

    foreach ($freshnessSources as $source) {
        if (is_file($source) && $cacheMtime < filemtime($source)) {
            return false;
        }
    }

    return true;
}

function serve_static_file(string $path, string $uri): void
{
    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $cacheControl = preg_match('#^/(build|images|storage)/#', $uri)
        ? 'public, max-age=31536000, immutable'
        : 'public, max-age=3600';

    serve_body(file_get_contents($path) ?: '', mime_type_for($extension), $cacheControl, $extension);
}

function serve_body(string $body, string $contentType, string $cacheControl, ?string $extension = 'html'): void
{
    header('Content-Type: '.$contentType);
    header('Cache-Control: '.$cacheControl);
    header('Vary: Accept-Encoding');
    header_remove('Content-Length');

    if (can_gzip($extension) && accepts_gzip()) {
        $body = gzencode($body, 6);
        header('Content-Encoding: gzip');
    }

    header('Content-Length: '.strlen($body));
    echo $body;
}

function can_gzip(?string $extension): bool
{
    return in_array($extension, ['css', 'js', 'mjs', 'svg', 'html', 'json', 'txt', 'xml'], true);
}

function accepts_gzip(): bool
{
    return str_contains($_SERVER['HTTP_ACCEPT_ENCODING'] ?? '', 'gzip');
}

function mime_type_for(string $extension): string
{
    return match ($extension) {
        'css' => 'text/css; charset=UTF-8',
        'js', 'mjs' => 'application/javascript; charset=UTF-8',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'avif' => 'image/avif',
        'jpg', 'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
        'woff2' => 'font/woff2',
        'woff' => 'font/woff',
        'json' => 'application/json; charset=UTF-8',
        default => 'application/octet-stream',
    };
}

function send_security_headers(): void
{
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
    header('Cross-Origin-Opener-Policy: same-origin');
}
