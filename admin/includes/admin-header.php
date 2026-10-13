<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow">
<title><?= h($pageTitle ?? 'Admin Panel') ?> — CARE Admin</title>
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<style>
  body { background: var(--footer-bg); }
  .admin-shell { display:flex; min-height:100vh; }
  .admin-sidebar { width:230px; background:var(--navy); color:#fff; padding:24px 0; flex-shrink:0; }
  .admin-sidebar h2 { color:#fff; font-size:18px; padding:0 20px 20px; margin:0; border-bottom:1px solid rgba(255,255,255,.15); }
  .admin-sidebar a { display:block; padding:12px 20px; color:#e8e8f5; font-weight:600; font-size:14px; }
  .admin-sidebar a:hover, .admin-sidebar a.active { background:rgba(255,255,255,.12); color:#fff; }
  .admin-main { flex:1; padding:30px; max-width:1100px; }
  .admin-topbar { display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; }
  table.admin-table { width:100%; border-collapse:collapse; background:#fff; border-radius:10px; overflow:hidden; }
  table.admin-table th, table.admin-table td { padding:12px 14px; border-bottom:1px solid var(--border); text-align:left; font-size:14px; }
  table.admin-table th { background:var(--footer-bg); color:var(--navy); }
  .stat-cards { display:grid; grid-template-columns:repeat(auto-fit, minmax(170px,1fr)); gap:16px; margin-bottom:30px; }
  .stat-card { background:#fff; border-radius:12px; padding:20px; text-align:center; box-shadow:var(--shadow); }
  .stat-card .num { font-size:32px; font-weight:700; color:var(--navy); font-family:var(--font-display); }
  @media (max-width:900px) {
    .admin-shell { flex-direction:column; }
    .admin-sidebar { width:100%; display:flex; overflow-x:auto; padding:10px; }
    .admin-sidebar h2 { display:none; }
    .admin-sidebar a { white-space:nowrap; }
    .stat-cards { grid-template-columns:repeat(2,1fr); }
  }
  .badge { padding:4px 10px; border-radius:999px; font-size:12px; font-weight:700; }
  .badge-pending { background:#FFF3D6; color:#9a6b00; }
  .badge-confirmed { background:#E1F6E8; color:#1c7a3d; }
  .badge-cancelled { background:#FDEAEA; color:#a13030; }
  .action-link { font-size:13px; font-weight:700; margin-right:10px; }
  .action-link.danger { color:#c0392b; }
  /* button styled as an inline action link (for POST-based actions) */
  .action-form { display:inline; }
  .action-btn { background:none; border:none; padding:0; cursor:pointer; font:inherit; font-size:13px; font-weight:700; color:var(--navy); margin-right:10px; }
  .action-btn:hover { text-decoration:underline; }
  .action-btn.danger { color:#c0392b; }
</style>
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <h2>CARE Admin</h2>
    <a href="dashboard.php" class="<?= ($activeMenu ?? '') === 'dashboard' ? 'active' : '' ?>">📊 Dashboard</a>
    <a href="manage-events.php" class="<?= ($activeMenu ?? '') === 'events' ? 'active' : '' ?>">📅 Manage Events</a>
    <a href="manage-bookings.php" class="<?= ($activeMenu ?? '') === 'bookings' ? 'active' : '' ?>">🗓️ Bookings</a>
    <a href="manage-messages.php" class="<?= ($activeMenu ?? '') === 'messages' ? 'active' : '' ?>">✉️ Messages</a>
    <a href="change-password.php" class="<?= ($activeMenu ?? '') === 'change-password' ? 'active' : '' ?>">🔑 Change Password</a>
    <a href="<?= SITE_URL ?>/index.php" target="_blank">🌐 View Site</a>
    <a href="logout.php">🚪 Logout</a>
  </aside>
  <main class="admin-main">
