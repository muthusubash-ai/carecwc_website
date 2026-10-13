<?php
require_once __DIR__ . '/config.php';

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    // Fail gracefully without exposing DB details to visitors
    http_response_code(500);
    die('Site is temporarily unavailable. Please try again shortly.');
}

mysqli_set_charset($conn, 'utf8mb4');
