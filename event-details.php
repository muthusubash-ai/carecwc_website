<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$slug = $_GET['slug'] ?? '';
$stmt = mysqli_prepare($conn, "SELECT * FROM events WHERE slug = ? LIMIT 1");
mysqli_stmt_bind_param($stmt, 's', $slug);
mysqli_stmt_execute($stmt);
$event = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$event) {
    http_response_code(404);
    $pageTitle = "Event Not Found — CARE Family Counselling";
    include __DIR__ . '/includes/header.php';
    echo '<section class="container" style="padding:80px 0;"><div class="empty-state"><div class="empty-icon">🔍</div><h1>Event Not Found</h1><p>The event you\'re looking for doesn\'t exist or may have been removed.</p><a href="' . SITE_URL . '/events" class="btn btn-primary">Back to Events</a></div></section>';
    include __DIR__ . '/includes/footer.php';
    exit;
}

$isPast = $event['event_date'] < date('Y-m-d');

$pageTitle = $event['meta_title'] ?: ($event['title'] . ' | Events - CARE Family Counselling');
$pageDescription = $event['meta_description'] ?: $event['short_description'];
$pageCanonical = SITE_URL . "/events/" . $event["slug"];
$pageOgImage = $event['image'] ? SITE_URL . '/uploads/events/' . $event['image'] : null;
$activeNav = "events";
$pageSchema = [ eventSchema($event) ];

// Get related upcoming events (excluding current)
$related = [];
$relResult = mysqli_query($conn, "SELECT * FROM events WHERE slug != '" . mysqli_real_escape_string($conn, $slug) . "' AND event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3");
if ($relResult) while ($r = mysqli_fetch_assoc($relResult)) $related[] = $r;

include __DIR__ . '/includes/header.php';
?>

<!-- Article Header -->
<article class="event-article">
  <header class="event-article-header">
    <div class="container">
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="<?= SITE_URL ?>">Home</a> <span>›</span>
        <a href="<?= SITE_URL ?>/events">Events</a> <span>›</span>
        <span class="current"><?= h($event['title']) ?></span>
      </nav>
      <span class="eyebrow"><?= $isPast ? 'Past Event' : 'Upcoming Event' ?></span>
      <h1 class="event-article-title"><?= h($event['title']) ?></h1>
      <div class="event-article-meta">
        <span class="meta-item">📅 <?= formatDate($event['event_date']) ?></span>
        <?php if ($event['event_time']): ?>
          <span class="meta-item">⏰ <?= h($event['event_time']) ?></span>
        <?php endif; ?>
        <span class="meta-item">📍 <?= h($event['location'] ?: 'Online') ?></span>
      </div>
    </div>
  </header>

  <?php if ($event['image']): ?>
  <div class="container">
    <figure class="event-article-image">
      <img src="<?= SITE_URL ?>/uploads/events/<?= h($event['image']) ?>"
           alt="<?= h($event['title']) ?> — CARE Family Counselling, Chennai"
           loading="eager" decoding="async">
    </figure>
  </div>
  <?php endif; ?>

  <!-- Article Body + Sidebar -->
  <div class="container event-article-layout">
    <div class="event-article-content">
      <?php if ($event['short_description']): ?>
      <div class="event-lead">
        <?= h($event['short_description']) ?>
      </div>
      <?php endif; ?>

      <div class="event-body">
        <?= nl2br(h($event['description'])) ?>
      </div>

      <!-- Inline CTA -->
      <div class="event-inline-cta">
        <?php if (!$isPast): ?>
        <h3>Ready to join us?</h3>
        <p>Limited seats available. Reserve your spot now — it's free to enquire.</p>
        <div class="cta-buttons">
          <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Hi%20CARE%2C%20I%27d%20like%20to%20reserve%20a%20spot%20for%20the%20event%3A%20<?= urlencode($event['title']) ?>"
             target="_blank" rel="noopener" class="btn btn-primary">
            💬 Reserve on WhatsApp
          </a>
          <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline">Enquire via Form</a>
        </div>
        <?php else: ?>
        <h3>Missed this event?</h3>
        <p>Don't miss the next one — talk to our counsellors or follow us for updates.</p>
        <div class="cta-buttons">
          <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book a Session</a>
          <a href="<?= SITE_URL ?>/events" class="btn btn-outline">See Upcoming Events</a>
        </div>
        <?php endif; ?>
      </div>

      <!-- Share -->
      <div class="event-share">
        <span class="share-label">Share this event:</span>
        <a href="https://wa.me/?text=<?= urlencode($event['title'] . ' - ' . SITE_URL . '/events/' . $event['slug']) ?>"
           target="_blank" rel="noopener" aria-label="Share on WhatsApp" class="share-btn">WhatsApp</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . '/events/' . $event['slug']) ?>"
           target="_blank" rel="noopener" aria-label="Share on Facebook" class="share-btn">Facebook</a>
        <a href="https://x.com/intent/tweet?url=<?= urlencode(SITE_URL . '/events/' . $event['slug']) ?>&text=<?= urlencode($event['title']) ?>"
           target="_blank" rel="noopener" aria-label="Share on X" class="share-btn">X (Twitter)</a>
      </div>
    </div>

    <!-- Sticky Sidebar (RSVP Card) -->
    <aside class="event-article-sidebar">
      <div class="event-rsvp-card">
        <h3><?= $isPast ? 'Get Notified' : 'Reserve Your Spot' ?></h3>
        <div class="rsvp-details">
          <div class="rsvp-row">
            <span class="rsvp-label">Date</span>
            <span class="rsvp-value"><?= formatDate($event['event_date']) ?></span>
          </div>
          <?php if ($event['event_time']): ?>
          <div class="rsvp-row">
            <span class="rsvp-label">Time</span>
            <span class="rsvp-value"><?= h($event['event_time']) ?></span>
          </div>
          <?php endif; ?>
          <div class="rsvp-row">
            <span class="rsvp-label">Location</span>
            <span class="rsvp-value"><?= h($event['location'] ?: 'Online') ?></span>
          </div>
        </div>
        <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Hi%20CARE%2C%20I%27d%20like%20to%20<?= $isPast ? 'know%20about%20future%20events' : 'reserve%20a%20spot%20for%3A%20' . urlencode($event['title']) ?>"
           target="_blank" rel="noopener" class="btn btn-primary btn-block">
          <?= $isPast ? 'Notify Me' : 'Reserve on WhatsApp' ?>
        </a>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline btn-block" style="margin-top:8px;">
          Or Enquire via Form
        </a>
        <p class="rsvp-note">📞 <?= SITE_PHONE ?></p>
      </div>
    </aside>
  </div>
</article>

<!-- Related Events -->
<?php if (!empty($related)): ?>
<section class="section-alt">
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">More Events</span>
      <h2>You Might Also Like</h2>
    </div>
    <div class="events-grid">
      <?php foreach ($related as $rel): ?>
      <article class="event-card">
        <a href="<?= SITE_URL ?>/events/<?= h($rel['slug']) ?>" class="event-card-image-link">
          <div class="event-card-image">
            <img loading="lazy" decoding="async"
                 src="<?= $rel['image'] ? SITE_URL . '/uploads/events/' . h($rel['image']) : SITE_URL . '/assets/images/event-placeholder.webp' ?>"
                 alt="<?= h($rel['title']) ?>">
            <span class="event-card-badge upcoming">Upcoming</span>
          </div>
        </a>
        <div class="event-card-body">
          <div class="event-meta">
            <span class="event-meta-item">📅 <?= formatDate($rel['event_date']) ?></span>
          </div>
          <h3><a href="<?= SITE_URL ?>/events/<?= h($rel['slug']) ?>"><?= h($rel['title']) ?></a></h3>
          <p><?= h($rel['short_description']) ?></p>
          <a href="<?= SITE_URL ?>/events/<?= h($rel['slug']) ?>" class="btn btn-outline">View Details</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
