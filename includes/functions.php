<?php
require_once __DIR__ . '/db.php';

/** Escape output safely */
function h($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

/** Generate a URL-safe slug from a string */
function slugify($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = trim($text, '-');
    $text = strtolower($text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    return $text ?: 'n-a';
}

/** Ensure a slug is unique in the events table (ignores $ignoreId when editing) */
function uniqueEventSlug($conn, $baseSlug, $ignoreId = null) {
    $slug = $baseSlug;
    $i = 1;
    while (true) {
        if ($ignoreId) {
            $stmt = mysqli_prepare($conn, "SELECT id FROM events WHERE slug = ? AND id != ?");
            mysqli_stmt_bind_param($stmt, 'si', $slug, $ignoreId);
        } else {
            $stmt = mysqli_prepare($conn, "SELECT id FROM events WHERE slug = ?");
            mysqli_stmt_bind_param($stmt, 's', $slug);
        }
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) === 0) {
            return $slug;
        }
        $i++;
        $slug = $baseSlug . '-' . $i;
    }
}

/** Is this admin logged in? */
function isAdminLoggedIn() {
    return isset($_SESSION['admin_id']);
}

/** Force login for admin pages */
function requireAdminLogin() {
    if (!isAdminLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

/** Convert any internal URL to its clean, canonical form:
 *  - strips a trailing ".php"
 *  - collapses "/index" (home) to "/"
 *  - drops query strings for canonical purposes
 *  e.g. https://site/services.php?id=x -> https://site/services
 */
function cleanUrl($url) {
    $parts = parse_url($url);
    $path = $parts['path'] ?? '/';
    $path = preg_replace('/\.php$/i', '', $path);   // drop .php
    $path = preg_replace('#/index$#i', '/', $path); // index -> /
    if ($path === '') { $path = '/'; }
    $scheme = $parts['scheme'] ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
    $host = $parts['host'] ?? '';
    $port = !empty($parts['port']) ? ':' . $parts['port'] : '';
    return $scheme . '://' . $host . $port . $path;
}

/** Redirect helper */
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

/** Format a date nicely: 22 Jul 2026 */
function formatDate($date) {
    return date('d M Y', strtotime($date));
}

/** ---------- CSRF PROTECTION ----------
 *  Generates a per-session token and validates it on state-changing requests.
 */
function csrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/** Hidden form field containing the CSRF token */
function csrfField() {
    return '<input type="hidden" name="csrf_token" value="' . h(csrfToken()) . '">';
}

/** Validate the submitted CSRF token; abort the request if it fails */
function csrfCheck() {
    $sent = $_POST['csrf_token'] ?? '';
    if (!$sent || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $sent)) {
        http_response_code(403);
        die('Security check failed (invalid or expired form token). Please go back, refresh the page, and try again.');
    }
}

/** Simple flash message system using session */
function setFlash($msg, $type = 'success') {
    $_SESSION['flash'] = ['msg' => $msg, 'type' => $type];
}
function getFlash() {
    if (isset($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $f;
    }
    return null;
}
