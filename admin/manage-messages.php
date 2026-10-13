<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Messages";
$activeMenu = "messages";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['read'])) {
    csrfCheck();
    $id = (int) $_POST['read'];
    $stmt = mysqli_prepare($conn, "UPDATE contact_messages SET is_read = 1 WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    redirect('manage-messages.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    csrfCheck();
    $id = (int) $_POST['delete'];
    $stmt = mysqli_prepare($conn, "DELETE FROM contact_messages WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    redirect('manage-messages.php');
}

$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY created_at DESC");

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Contact Messages</h1>
</div>

<table class="admin-table">
  <thead>
    <tr><th>Name</th><th>Contact</th><th>Message</th><th>Received</th><th>Actions</th></tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($messages) === 0): ?>
      <tr><td colspan="5">No messages yet.</td></tr>
    <?php endif; ?>
    <?php while ($m = mysqli_fetch_assoc($messages)): ?>
      <tr style="<?= $m['is_read'] ? '' : 'font-weight:700;' ?>">
        <td><?= h($m['name']) ?></td>
        <td><?= h($m['phone']) ?><br><small><?= h($m['email']) ?></small></td>
        <td style="max-width:280px;"><?= nl2br(h($m['message'])) ?></td>
        <td><?= date('d M Y, h:i A', strtotime($m['created_at'])) ?></td>
        <td>
          <?php if (!$m['is_read']): ?>
            <form method="POST" class="action-form">
              <?= csrfField() ?>
              <input type="hidden" name="read" value="<?= $m['id'] ?>">
              <button type="submit" class="action-btn">Mark Read</button>
            </form>
          <?php endif; ?>
          <form method="POST" class="action-form" onsubmit="return confirm('Delete this message?');">
            <?= csrfField() ?>
            <input type="hidden" name="delete" value="<?= $m['id'] ?>">
            <button type="submit" class="action-btn danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
