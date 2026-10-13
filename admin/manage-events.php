<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Manage Events";
$activeMenu = "events";

// Handle delete (POST + CSRF only)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    csrfCheck();
    $id = (int) $_POST['delete'];
    $stmt = mysqli_prepare($conn, "SELECT image FROM events WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if ($row && $row['image']) {
        $path = __DIR__ . '/../uploads/events/' . $row['image'];
        if (file_exists($path)) unlink($path);
    }
    $del = mysqli_prepare($conn, "DELETE FROM events WHERE id = ?");
    mysqli_stmt_bind_param($del, 'i', $id);
    mysqli_stmt_execute($del);
    setFlash('Event deleted successfully.');
    redirect('manage-events.php');
}

$flash = getFlash();
$events = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Manage Events</h1>
  <a href="add-event.php" class="btn btn-primary">+ Add New Event</a>
</div>

<?php if ($flash): ?>
  <div class="alert alert-<?= $flash['type'] === 'success' ? 'success' : 'error' ?>"><?= h($flash['msg']) ?></div>
<?php endif; ?>

<table class="admin-table">
  <thead>
    <tr><th>Title</th><th>Date</th><th>Status</th><th>Actions</th></tr>
  </thead>
  <tbody>
    <?php if (mysqli_num_rows($events) === 0): ?>
      <tr><td colspan="4">No events added yet. <a href="add-event.php">Add your first event</a>.</td></tr>
    <?php endif; ?>
    <?php while ($ev = mysqli_fetch_assoc($events)): ?>
      <?php $isPast = $ev['event_date'] < date('Y-m-d'); ?>
      <tr>
        <td><?= h($ev['title']) ?></td>
        <td><?= formatDate($ev['event_date']) ?></td>
        <td><span class="badge <?= $isPast ? 'badge-cancelled' : 'badge-confirmed' ?>"><?= $isPast ? 'Completed' : 'Upcoming' ?></span></td>
        <td>
          <a class="action-link" href="edit-event.php?id=<?= $ev['id'] ?>">Edit</a>
          <form method="POST" class="action-form" onsubmit="return confirm('Delete this event? This cannot be undone.');">
            <?= csrfField() ?>
            <input type="hidden" name="delete" value="<?= $ev['id'] ?>">
            <button type="submit" class="action-btn danger">Delete</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
