<?php
/**
 * ONE-TIME SETUP / SAFE RESET SCRIPT
 * -----------------------------------------------------------
 * FIRST RUN (no admin exists yet):
 *   Visit https://carecwc.com/admin/create-admin.php once to create the
 *   admin account using the username/password below, then delete this file.
 *
 * LATER (an admin already exists):
 *   For safety, this script now REFUSES to run unless you are already
 *   logged in to the admin panel. Anonymous visitors can no longer reset
 *   your password. To change your password, log in and use the new
 *   "Change Password" page instead.
 *
 *   If you are fully locked out, reset the password via phpMyAdmin, or
 *   temporarily remove the guard block below, run once, then delete the file.
 * -----------------------------------------------------------
 */

require_once __DIR__ . '/../includes/functions.php'; // gives DB + session helpers

// 👉 CHANGE THESE before first run, then DELETE THIS FILE after use.
$username = 'admin';
$password = 'CHANGE_ME_NOW_2026!'; // ⚠️ Set a strong password, then delete this file!

// ---- SECURITY GUARD ----
$adminCount = (int) mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM admin_users"))['c'];
if ($adminCount > 0 && !isAdminLoggedIn()) {
    http_response_code(403);
    die('An admin account already exists. For security, this reset tool is disabled for anonymous visitors. '
      . 'Please log in and use the "Change Password" page instead.');
}
// -------------------------

$hash = password_hash($password, PASSWORD_DEFAULT);

$check = mysqli_query($conn, "SELECT id FROM admin_users WHERE username = '" . mysqli_real_escape_string($conn, $username) . "'");

if (mysqli_num_rows($check) > 0) {
    $stmt = mysqli_prepare($conn, "UPDATE admin_users SET password = ? WHERE username = ?");
    mysqli_stmt_bind_param($stmt, 'ss', $hash, $username);
    mysqli_stmt_execute($stmt);
    echo "Admin password updated successfully for username: " . htmlspecialchars($username);
} else {
    $stmt = mysqli_prepare($conn, "INSERT INTO admin_users (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
    mysqli_stmt_execute($stmt);
    echo "Admin account created successfully for username: " . htmlspecialchars($username);
}

echo "<br><br><strong>⚠️ Please delete this file (create-admin.php) from your server now.</strong>";
