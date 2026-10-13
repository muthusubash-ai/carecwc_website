<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Dashboard";
$activeMenu = "dashboard";

$today = date('Y-m-d');
$totalEvents = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM events"))['c'];

$stmtUp = mysqli_prepare($conn, "SELECT COUNT(*) c FROM events WHERE event_date >= ?");
mysqli_stmt_bind_param($stmtUp, 's', $today);
mysqli_stmt_execute($stmtUp);
$upcomingEvents = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtUp))['c'];

$stmtPast = mysqli_prepare($conn, "SELECT COUNT(*) c FROM events WHERE event_date < ?");
mysqli_stmt_bind_param($stmtPast, 's', $today);
mysqli_stmt_execute($stmtPast);
$pastEvents = mysqli_fetch_assoc(mysqli_stmt_get_result($stmtPast))['c'];

$newBookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM bookings WHERE status = 'pending'"))['c'];
$unreadMessages = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) c FROM contact_messages WHERE is_read = 0"))['c'];

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Welcome, <?= h($_SESSION['admin_username']) ?> 👋</h1>
</div>

<div class="stat-cards">
  <div class="stat-card"><div class="num"><?= $totalEvents ?></div><div>Total Events</div></div>
  <div class="stat-card"><div class="num"><?= $upcomingEvents ?></div><div>Upcoming Events</div></div>
  <div class="stat-card"><div class="num"><?= $pastEvents ?></div><div>Past Events</div></div>
  <div class="stat-card"><div class="num"><?= $newBookings ?></div><div>Pending Bookings</div></div>
  <div class="stat-card"><div class="num"><?= $unreadMessages ?></div><div>Unread Messages</div></div>
</div>

<div class="grid grid-2">
  <div class="card">
    <h3>Quick Actions</h3>
    <p><a href="add-event.php" class="btn btn-primary">+ Add New Event</a></p>
    <p><a href="manage-bookings.php" class="btn btn-outline">View Bookings (<?= $newBookings ?> pending)</a></p>
    <p class="mb-0"><a href="manage-messages.php" class="btn btn-outline">View Messages (<?= $unreadMessages ?> unread)</a></p>
  </div>
  <div class="card">
    <h3>Tips</h3>
    <p class="mb-0">Upcoming vs Past events are calculated automatically based on the event date you set — no manual status switching needed.</p>
  </div>
</div>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
