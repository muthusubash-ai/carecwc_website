<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Manage Bookings";
$activeMenu = "bookings";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'], $_POST['id'])) {
    csrfCheck();
    $id = (int) $_POST['id'];
    $status = in_array($_POST['status'], ['pending','confirmed','cancelled']) ? $_POST['status'] : 'pending';
    $stmt = mysqli_prepare($conn, "UPDATE bookings SET status = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'si', $status, $id);
    mysqli_stmt_execute($stmt);
    redirect('manage-bookings.php');
}

$bookings = mysqli_query($conn, "SELECT * FROM bookings ORDER BY created_at DESC");

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Bookings</h1>
</div>

<table class="admin-table">
  <thead>
    <tr><th>Name</th><th>Contact</th><th>Service</th><th>Preferred Slot</th><th>Status</th><th>Actions</th></tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($bookings) === 0): ?>
      <tr><td colspan="6">No bookings yet.</td></tr>
    <?php endif; ?>
    <?php while ($b = mysqli_fetch_assoc($bookings)): ?>
      <tr>
        <td><?= h($b['name']) ?></td>
        <td><?= h($b['phone']) ?><br><small><?= h($b['email']) ?></small></td>
        <td><?= h($b['service']) ?></td>
        <td><?= formatDate($b['preferred_date']) ?><br><small><?= h($b['preferred_time']) ?></small></td>
        <td><span class="badge badge-<?= $b['status'] ?>"><?= ucfirst($b['status']) ?></span></td>
        <td>
          <?php if ($b['status'] !== 'confirmed'): ?>
            <form method="POST" class="action-form">
              <?= csrfField() ?>
              <input type="hidden" name="id" value="<?= $b['id'] ?>">
              <input type="hidden" name="status" value="confirmed">
              <button type="submit" class="action-btn">Confirm</button>
            </form>
          <?php endif; ?>
          <?php if ($b['status'] !== 'cancelled'): ?>
            <form method="POST" class="action-form" onsubmit="return confirm('Cancel this booking?');">
              <?= csrfField() ?>
              <input type="hidden" name="id" value="<?= $b['id'] ?>">
              <input type="hidden" name="status" value="cancelled">
              <button type="submit" class="action-btn danger">Cancel</button>
            </form>
          <?php endif; ?>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
