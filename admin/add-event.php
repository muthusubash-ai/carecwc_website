<?php
require_once __DIR__ . '/includes/auth.php';
$pageTitle = "Add New Event";
$activeMenu = "events";

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
        $errors[] = "Event Title and Event Date are required.";
    }
    if ($short_description === '') {
        $errors[] = "Short description helps in listings and search results — please add one.";
    }

    $imageName = null;
    if (!empty($_FILES['image']['name'])) {
        $allowed = ['jpg','jpeg','png','webp'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            $errors[] = "Event image must be JPG, PNG, or WEBP format.";
        } elseif ($_FILES['image']['size'] > 3 * 1024 * 1024) {
            $errors[] = "Event image must be under 3 MB.";
        } else {
            $imageName = 'event-' . time() . '-' . rand(1000,9999) . '.' . $ext;
            $destination = __DIR__ . '/../uploads/events/' . $imageName;
            if (!is_dir(dirname($destination))) mkdir(dirname($destination), 0755, true);
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $errors[] = "Failed to upload image. Please try again.";
                $imageName = null;
            }
        }
    }

    if (empty($errors)) {
        $baseSlug = slugify($title);
        $slug = uniqueEventSlug($conn, $baseSlug);

        $stmt = mysqli_prepare($conn, "INSERT INTO events (title, slug, description, short_description, image, event_date, event_time, location, meta_title, meta_description) VALUES (?,?,?,?,?,?,?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssssssssss', $title, $slug, $description, $short_description, $imageName, $event_date, $event_time, $location, $meta_title, $meta_description);
        if (mysqli_stmt_execute($stmt)) {
            setFlash('Event added successfully.');
            redirect('manage-events.php');
        } else {
            $errors[] = "Database error. Please try again.";
        }
    }
}

include __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-container">
  <div class="admin-card">
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:8px;">
      <h2 style="border:none;padding:0;margin:0;">Add New Event</h2>
      <a href="manage-events.php" class="btn btn-outline">&larr; Back to Events</a>
    </div>
    <p style="color:var(--slate-gray);margin:0 0 20px;">Create a new event, workshop, or webinar. It will appear on the live site immediately.</p>

    <?php foreach ($errors as $e): ?>
      <div class="admin-alert error"><?= h($e) ?></div>
    <?php endforeach; ?>

    <form method="POST" enctype="multipart/form-data" class="admin-form">
      <?= csrfField() ?>
      <label for="title">Event Title <span style="color:#d92e2e">*</span> <small>e.g. "Parenting Workshop for Teenagers"</small></label>
      <input type="text" id="title" name="title" required maxlength="120" value="<?= h($_POST['title'] ?? '') ?>" placeholder="A short, clear title">

      <label for="short_description">Short Description <span style="color:#d92e2e">*</span> <small>1-2 lines &mdash; used in event listings &amp; search results</small></label>
      <textarea id="short_description" name="short_description" required maxlength="200" style="min-height:70px;" placeholder="A brief hook that makes people want to learn more (max 200 characters)"><?= h($_POST['short_description'] ?? '') ?></textarea>
      <div class="help-text"><span id="short_desc_count">0</span> / 200 characters</div>

      <label for="description">Full Description / Blog Content <small>Full details, agenda, speakers, what attendees will learn (supports line breaks)</small></label>
      <textarea id="description" name="description" style="min-height:280px;" placeholder="Write the complete event details here. Use line breaks to separate paragraphs."><?= h($_POST['description'] ?? '') ?></textarea>

      <div class="form-row-2">
        <div>
          <label for="event_date">Event Date <span style="color:#d92e2e">*</span></label>
          <input type="date" id="event_date" name="event_date" required min="<?= date('Y-m-d') ?>" value="<?= h($_POST['event_date'] ?? '') ?>">
        </div>
        <div>
          <label for="event_time">Event Time <small>e.g. 5:00 PM - 6:30 PM</small></label>
          <input type="text" id="event_time" name="event_time" value="<?= h($_POST['event_time'] ?? '') ?>" placeholder="5:00 PM - 6:30 PM">
        </div>
      </div>

      <label for="location">Location <small>"Online" for virtual, or full address</small></label>
      <input type="text" id="location" name="location" value="<?= h($_POST['location'] ?? 'Online') ?>" placeholder="Online / Chennai / Zoom">

      <label for="image">Event Image <small>JPG/PNG/WebP, under 3 MB</small></label>
      <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
      <div class="help-text" style="background:#FBF7EE;border-left:3px solid var(--marigold);padding:10px 14px;margin-top:8px;border-radius:6px;">
        &#128208; <strong>Recommended image size:</strong> <strong>1200 &times; 675 px</strong> (16:9 ratio) for best display on all devices.<br>
        The image will be shown in event listings, on the details page hero, and when shared on social media.
      </div>

      <hr style="margin:26px 0;border:none;border-top:1px solid var(--border);">

      <h3 style="color:var(--navy);font-size:16px;margin:0 0 4px;">SEO Settings <small style="font-weight:400;color:var(--slate-gray);font-size:13px;">(optional &mdash; improves Google search visibility)</small></h3>

      <label for="meta_title">SEO Meta Title <small>Under 60 characters recommended</small></label>
      <input type="text" id="meta_title" name="meta_title" maxlength="70" value="<?= h($_POST['meta_title'] ?? '') ?>" placeholder="If empty, event title is used">

      <label for="meta_description">SEO Meta Description <small>Under 160 characters</small></label>
      <textarea id="meta_description" name="meta_description" maxlength="200" style="min-height:60px;" placeholder="If empty, short description is used"><?= h($_POST['meta_description'] ?? '') ?></textarea>

      <div class="btn-row">
        <button type="submit" class="btn btn-primary">Save Event</button>
        <a href="manage-events.php" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>

<script>
  const sd = document.getElementById('short_description');
  const sdCount = document.getElementById('short_desc_count');
  function updateCount(){ sdCount.textContent = sd.value.length; }
  sd.addEventListener('input', updateCount);
  updateCount();
</script>

<?php include __DIR__ . '/includes/admin-footer.php'; ?>

