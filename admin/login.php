<?php
require_once __DIR__ . '/../includes/functions.php';

if (isAdminLoggedIn()) {
    redirect('dashboard.php');
}

/* ---------- BRUTE-FORCE LOCKOUT (file-based, no DB schema change) ----------
 * Tracks failed attempts per IP in the server temp dir.
 * After MAX_ATTEMPTS failures, logins are blocked for LOCK_MINUTES.
 */
const MAX_ATTEMPTS = 5;
const LOCK_MINUTES = 15;
const ATTEMPT_WINDOW = 900; // 15 min rolling window to count attempts

function throttleFile() {
    $ip  = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $key = hash('sha256', 'carecwc-login|' . $ip);
    return sys_get_temp_dir() . '/carecwc_login_' . $key . '.json';
}
function throttleRead() {
    $f = throttleFile();
    if (is_file($f)) {
        $data = json_decode((string) file_get_contents($f), true);
        if (is_array($data)) return $data;
    }
    return ['count' => 0, 'first' => 0, 'locked_until' => 0];
}
function throttleWrite($data) {
    @file_put_contents(throttleFile(), json_encode($data), LOCK_EX);
}
function throttleClear() {
    $f = throttleFile();
    if (is_file($f)) @unlink($f);
}

$error = '';
$state = throttleRead();
$now   = time();

// Currently locked?
$lockedRemaining = 0;
if (($state['locked_until'] ?? 0) > $now) {
    $lockedRemaining = (int) ceil(($state['locked_until'] - $now) / 60);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($lockedRemaining > 0) {
        $error = "Too many failed attempts. Please try again in {$lockedRemaining} minute(s).";
    } else {
        csrfCheck();

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM admin_users WHERE username = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        $admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        if ($admin && password_verify($password, $admin['password'])) {
            // Success — clear throttle, regenerate session (fixation defence)
            throttleClear();
            session_regenerate_id(true);
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            redirect('dashboard.php');
        } else {
            // Failure — record attempt
            if (($state['first'] ?? 0) === 0 || ($now - $state['first']) > ATTEMPT_WINDOW) {
                $state['first'] = $now;
                $state['count'] = 0;
            }
            $state['count'] = (int) $state['count'] + 1;

            if ($state['count'] >= MAX_ATTEMPTS) {
                $state['locked_until'] = $now + (LOCK_MINUTES * 60);
                $lockedRemaining = LOCK_MINUTES;
                $error = "Too many failed attempts. Login blocked for " . LOCK_MINUTES . " minutes.";
            } else {
                $left = MAX_ATTEMPTS - $state['count'];
                $error = "Invalid username or password. {$left} attempt(s) left before a temporary block.";
            }
            throttleWrite($state);
            // small delay slows scripted guessing
            usleep(400000);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title>Admin Login — CARE Family Counselling</title>
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<style>
  body { background: linear-gradient(135deg, var(--navy), var(--lavender)); min-height:100vh; display:flex; align-items:center; justify-content:center; }
  .login-card { background:#fff; padding:40px; border-radius:16px; width:100%; max-width:380px; box-shadow:0 10px 40px rgba(0,0,0,.2); }
</style>
</head>
<body>
  <div class="login-card">
    <h2 class="text-center">CARE Admin Login</h2>
    <?php if ($error): ?>
      <div class="alert alert-error"><?= h($error) ?></div>
    <?php endif; ?>
    <form method="POST">
      <?= csrfField() ?>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required autofocus <?= $lockedRemaining > 0 ? 'disabled' : '' ?>>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required <?= $lockedRemaining > 0 ? 'disabled' : '' ?>>
      <button type="submit" class="btn btn-primary btn-block" <?= $lockedRemaining > 0 ? 'disabled' : '' ?>>Log In</button>
    </form>
  </div>
</body>
</html>
