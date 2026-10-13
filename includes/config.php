<?php
/**
 * CARE Family Counselling & Children's Wellness Center
 * Global Configuration
 *
 * IMPORTANT: Update the DB_* values below with the credentials
 * Hostinger gives you in hPanel > Databases > MySQL Databases.
 */

// ---------- ENVIRONMENT DETECTION ----------
$isLocal = (isset($_SERVER['HTTP_HOST']) && (
    strpos($_SERVER['HTTP_HOST'], 'localhost') !== false ||
    strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false
)) || (php_sapi_name() === 'cli-server');

if ($isLocal) {
    // ---------- LOCAL DATABASE (XAMPP / Local MySQL) ----------
    define('DB_HOST', '127.0.0.1');
    define('DB_NAME', 'carecwc');
    define('DB_USER', 'root');
    define('DB_PASS', '');

    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost:8000';
    $baseFolder = '';
    if (isset($_SERVER['SCRIPT_NAME']) && php_sapi_name() !== 'cli-server') {
        $parts = explode('/', trim(str_replace('\\', '/', $_SERVER['SCRIPT_NAME']), '/'));
        if (count($parts) > 1 && $parts[0] !== 'admin' && $parts[0] !== 'includes') {
            $baseFolder = '/' . $parts[0];
        }
    }
    define('SITE_URL', $scheme . $host . $baseFolder);
} else {
    // ---------- LIVE DATABASE (Hostinger) ----------
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'u328198334_carefamily');
    define('DB_USER', 'u328198334_care_family');
    define('DB_PASS', 'Thilagam@1411');
    define('SITE_URL', 'https://carecwc.com');       // LIVE DOMAIN
}

// ---------- SITE ----------
define('SITE_NAME', "CARE Family Counselling & Children's Wellness Center");
define('SITE_PHONE', '+91 99658 55184');
define('SITE_PHONE_LINK', '+919965855184');       // for tel: links, no spaces
define('SITE_WHATSAPP', '919965855184');          // for wa.me links, country code no +
define('SITE_EMAIL', 'contact@carecwc.com');
define('CAREER_EMAIL', 'hire.care.cwc@gmail.com');
define('SITE_ADDRESS', 'Plot # 156, Door # 5A, 6th Street, Kamakoti Nagar, Pallikaranai, Chennai - 600100');
define('SITE_ADDRESS_HTML', 'Plot # 156, Door # 5A,<br>6th Street, Kamakoti Nagar,<br>Pallikaranai, Chennai - 600100');
define('SITE_INSTAGRAM', 'https://www.instagram.com/carewellnesstalks');
define('SITE_FACEBOOK', 'https://www.facebook.com/CAREWellnessTalks');
define('SITE_YOUTUBE', 'https://www.youtube.com/@CAREWellnessTalks');
define('SITE_MAPS_URL', 'https://www.google.com/maps/search/CARE%20Counseling%20and%20Wellness%20Center/@12.94107465,80.2105953,17z?hl=en');
define('SITE_MAPS_EMBED_LAT', '12.941073');
define('SITE_MAPS_EMBED_LNG', '80.210590');

// ---------- ERROR REPORTING (turn OFF display_errors on live site) ----------
error_reporting(E_ALL);
ini_set('display_errors', $isLocal ? 1 : 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../error.log');

// ---------- SESSION ----------
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
        ini_set('session.cookie_secure', 1);
    }
    ini_set('session.cookie_samesite', 'Lax');
    ini_set('session.use_strict_mode', 1);
    session_start();
}

// ---------- TIMEZONE ----------
date_default_timezone_set('Asia/Kolkata');
