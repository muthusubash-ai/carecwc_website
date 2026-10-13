<?php
/**
 * Router script for PHP Built-in Development Server
 * Usage: php -S localhost:8000 router.php
 */

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $uri;

// 1. If static file exists, return false to let PHP built-in server serve it
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// 2. Root homepage
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    exit;
}

// 3. Sitemap XML
if ($uri === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    exit;
}

// 4. Dynamic Event details URL: /events/<slug>
if (preg_match('#^/events/([a-zA-Z0-9\-]+)/?$#', $uri, $matches)) {
    $_GET['slug'] = $matches[1];
    require __DIR__ . '/event-details.php';
    exit;
}

// 5. Clean URLs without .php extension (e.g. /services, /contact, /psychologists)
$phpFile = __DIR__ . $uri . '.php';
if (file_exists($phpFile)) {
    require $phpFile;
    exit;
}

// 6. Directory navigation (e.g. /admin -> /admin/dashboard.php or login.php)
if (is_dir($file)) {
    if (file_exists($file . '/index.php')) {
        require $file . '/index.php';
        exit;
    }
    if (rtrim($uri, '/') === '/admin') {
        require __DIR__ . '/admin/login.php';
        exit;
    }
}

// 7. 404 fallback
http_response_code(404);
if (file_exists(__DIR__ . '/404.php')) {
    require __DIR__ . '/404.php';
} else {
    echo '<h1>404 - Page Not Found</h1>';
}
exit;
