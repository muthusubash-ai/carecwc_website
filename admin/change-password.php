<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Change Password";
$activeMenu = "change-password";

$errors  = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrfCheck();

    $current = $_POST['current_password'] ?? '';
    $new     = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    // Fetch current hash for the logged-in admin
    $stmt = mysqli_prepare($conn, "SELECT password FROM admin_users WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, 'i', $_SESSION['admin_id']);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    if (!$row) {
        $errors[] = "Your account could not be found. Please log in again.";
    } elseif (!password_verify($current, $row['password'])) {
        $errors[] = "Your current password is incorrect.";
    }

    if (strlen($new) < 8) {
        $errors[] = "New password must be at least 8 characters long.";
    }
    if ($new !== $confirm) {
        $errors[] = "New password and confirmation do not match.";
    }
    if ($row && password_verify($new, $row['password'])) {
        $errors[] = "New password must be different from your current password.";
    }

    if (empty($errors)) {
        $hash = password_hash($new, PASSWORD_DEFAULT);
        $upd = mysqli_prepare($conn, "UPDATE admin_users SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($upd, 'si', $hash, $_SESSION['admin_id']);
        if (mysqli_stmt_execute($upd)) {
            $success = true;
        } else {
            $errors[] = "Database error. Please try again.";
        }
    }
}

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Change Password</h1>
</div>

<?php if ($success): ?>
  <div class="alert alert-success">Your password has been changed successfully. Use the new password next time you log in.</div>
<?php endif; ?>

<?php foreach ($errors as $e): ?>
  <div class="alert alert-error"><?= h($e) ?></div>
<?php endforeach; ?>

<div class="form-card" style="max-width:480px;">
  <form method="POST" autocomplete="off">
    <?= csrfField() ?>

    <label for="current_password">Current Password</label>
    <input type="password" id="current_password" name="current_password" required autocomplete="current-password">

    <label for="new_password">New Password <small>at least 8 characters</small></label>
    <input type="password" id="new_password" name="new_password" required minlength="8" autocomplete="new-password">

    <label for="confirm_password">Confirm New Password</label>
    <input type="password" id="confirm_password" name="confirm_password" required minlength="8" autocomplete="new-password">

    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
  </form>
  <p style="margin-top:16px;font-size:13px;color:var(--slate-gray, #667);">
    Tip: use a mix of letters, numbers and symbols. You will stay logged in after changing it.
  </p>
</div>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
