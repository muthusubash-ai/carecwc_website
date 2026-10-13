<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Edit Event";
$activeMenu = "events";

$id = (int) ($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE id = ?");
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$event) {
    setFlash('Event not found.', 'error');
    redirect('manage-events.php');
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrfCheck();
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $event_date = trim($_POST['event_date'] ?? '');
    $event_time = trim($_POST['event_time'] ?? '');
    $location = trim($_POST['location'] ?? 'Online');
    $meta_title = trim($_POST['meta_title'] ?? '');
    $meta_description = trim($_POST['meta_description'] ?? '');

    if ($title === '' || $event_date === '') {
        $errors[] = "Title and Event Date are required.";
    }

    $imageName = $event['image'];
    if (!empty($_FILES['image']['name'])) {
        $allowed = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $errors[] = "Event image must be JPG, PNG, or WEBP.";
        } elseif ($_FILES['image']['size'] > 3 * 1024 * 1024) {
            $errors[] = "Event image must be under 3MB.";
        } else {
            $newImageName = 'event-' . time() . '-' . rand(1000,9999) . '.' . $ext;
            $destination = __DIR__ . '/../uploads/events/' . $newImageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                if ($imageName && file_exists(__DIR__ . '/../uploads/events/' . $imageName)) {
                    unlink(__DIR__ . '/../uploads/events/' . $imageName);
                }
                $imageName = $newImageName;
            } else {
                $errors[] = "Failed to upload new image.";
            }
        }
    }

    if (empty($errors)) {
        // Re-slugify only if title changed
        $slug = $event['slug'];
        if (slugify($title) !== $event['slug']) {
            $slug = uniqueEventSlug($conn, slugify($title), $id);
        }

        $upd = mysqli_prepare($conn, "UPDATE events SET title=?, slug=?, description=?, short_description=?, image=?, event_date=?, event_time=?, location=?, meta_title=?, meta_description=? WHERE id=?");
        mysqli_stmt_bind_param($upd, 'ssssssssssi', $title, $slug, $description, $short_description, $imageName, $event_date, $event_time, $location, $meta_title, $meta_description, $id);
        if (mysqli_stmt_execute($upd)) {
            setFlash('Event updated successfully.');
            redirect('manage-events.php');
        } else {
            $errors[] = "Database error. Please try again.";
        }
    }
}

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-topbar">
  <h1 class="mt-0 mb-0">Edit Event</h1>
  <a href="manage-events.php" class="btn btn-outline">← Back to Events</a>
</div>

<?php foreach ($errors as $e): ?>
  <div class="alert alert-error"><?= h($e) ?></div>
<?php endforeach; ?>

<div class="form-card" style="max-width:700px;">
  <form method="POST" enctype="multipart/form-data">
    <?= csrfField() ?>
    <label for="title">Event Title *</label>
    <input type="text" id="title" name="title" required value="<?= h($event['title']) ?>">

    <label for="short_description">Short Description</label>
    <textarea id="short_description" name="short_description" maxlength="300"><?= h($event['short_description']) ?></textarea>

    <label for="description">Full Description</label>
    <textarea id="description" name="description" style="min-height:180px;"><?= h($event['description']) ?></textarea>

    <label for="event_date">Event Date *</label>
    <input type="date" id="event_date" name="event_date" required value="<?= h($event['event_date']) ?>">

    <label for="event_time">Event Time</label>
    <input type="text" id="event_time" name="event_time" value="<?= h($event['event_time']) ?>">

    <label for="location">Location</label>
    <input type="text" id="location" name="location" value="<?= h($event['location']) ?>">

    <?php if ($event['image']): ?>
      <label>Current Image</label>
      <img src="<?= SITE_URL ?>/uploads/events/<?= h($event['image']) ?>" style="max-width:200px;border-radius:10px;margin-bottom:14px;">
    <?php endif; ?>
    <label for="image">Replace Image (optional)</label>
    <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">

    <label for="meta_title">SEO Meta Title (optional)</label>
    <input type="text" id="meta_title" name="meta_title" value="<?= h($event['meta_title']) ?>">

    <label for="meta_description">SEO Meta Description (optional)</label>
    <textarea id="meta_description" name="meta_description" maxlength="300"><?= h($event['meta_description']) ?></textarea>

    <button type="submit" class="btn btn-primary btn-block">Update Event</button>
  </form>
</div>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>
