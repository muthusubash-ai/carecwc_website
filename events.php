<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Mental Health Events & Workshops in Chennai | CARE Wellness Center";
$pageDescription = "Attend expert-led wellness workshops in Chennai: parenting webinars, relationship seminars, stress management sessions, and mental health awareness programs by CARE Family Counselling.";
$pageKeywords = "mental health workshops Chennai, parenting webinars, counselling events, wellness workshop, family therapy seminar Chennai";
$pageCanonical = SITE_URL . "/events";
$activeNav = "events";

// Fetch events split by date automatically
$upcoming = [];
$past = [];

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date ASC");
if ($result) {
    $today = date('Y-m-d');
    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['event_date'] >= $today) {
            $upcoming[] = $row;
        } else {
            $past[] = $row;
        }
    }
}
$past = array_reverse($past);

$eventSchemas = array_map('eventSchema', $upcoming);
$pageSchema = $eventSchemas;

include __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="events-hero">
  <div class="container">
    <span class="eyebrow">Stay Involved</span>
    <h1>Events &amp; Workshops</h1>
    <p class="lead">Join our expert-led wellness workshops, parenting webinars, and community sessions on mental health, relationships, and personal growth.</p>
    <?php if (!empty($upcoming)): ?>
    <div class="events-hero-cta">
      <a href="#upcoming-events" class="btn btn-primary">See Upcoming Events</a>
      <a href="https://wa.me/<?= SITE_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">Reserve on WhatsApp</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Events Tabs -->
<section id="upcoming-events" class="events-section">
  <div class="container">
    <div class="tabs events-tabs">
      <button class="tab-btn active" data-target="upcoming">
        Upcoming <span class="tab-count"><?= count($upcoming) ?></span>
      </button>
      <button class="tab-btn" data-target="past">
        Past <span class="tab-count"><?= count($past) ?></span>
      </button>
    </div>

    <!-- Upcoming Events -->
    <div data-panel="upcoming">
      <?php if (empty($upcoming)): ?>
        <div class="empty-state">
          <div class="empty-icon">📅</div>
          <h3>New events coming soon!</h3>
          <p>We're planning our next workshop. Follow us on Instagram or WhatsApp us to be notified.</p>
          <div class="empty-actions">
            <a href="<?= SITE_INSTAGRAM ?>" target="_blank" rel="noopener" class="btn btn-outline">Follow on Instagram</a>
            <a href="https://wa.me/<?= SITE_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-primary">Notify Me</a>
          </div>
        </div>
      <?php else: ?>
        <div class="events-grid">
          <?php foreach ($upcoming as $ev): ?>
          <article class="event-card">
            <a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>" class="event-card-image-link">
              <div class="event-card-image">
                <img loading="lazy" decoding="async"
                     src="<?= $ev['image'] ? SITE_URL . '/uploads/events/' . h($ev['image']) : SITE_URL . '/assets/images/event-placeholder.webp' ?>"
                     alt="<?= h($ev['title']) ?> — Wellness workshop in Chennai by CARE">
                <span class="event-card-badge upcoming">Upcoming</span>
              </div>
            </a>
            <div class="event-card-body">
              <div class="event-meta">
                <span class="event-meta-item">📅 <?= formatDate($ev['event_date']) ?></span>
                <?php if ($ev['event_time']): ?>
                  <span class="event-meta-item">⏰ <?= h($ev['event_time']) ?></span>
                <?php endif; ?>
                <?php if ($ev['location']): ?>
                  <span class="event-meta-item">📍 <?= h($ev['location']) ?></span>
                <?php endif; ?>
              </div>
              <h3><a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>"><?= h($ev['title']) ?></a></h3>
              <p><?= h($ev['short_description']) ?></p>
              <div class="event-card-cta">
                <a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>" class="btn btn-primary">Reserve Your Spot</a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Past Events -->
    <div data-panel="past" style="display:none;">
      <?php if (empty($past)): ?>
        <div class="empty-state">
          <div class="empty-icon">🗓️</div>
          <h3>No past events to show yet</h3>
        </div>
      <?php else: ?>
        <div class="events-grid">
          <?php foreach ($past as $ev): ?>
          <article class="event-card past">
            <a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>" class="event-card-image-link">
              <div class="event-card-image">
                <img loading="lazy" decoding="async"
                     src="<?= $ev['image'] ? SITE_URL . '/uploads/events/' . h($ev['image']) : SITE_URL . '/assets/images/event-placeholder.webp' ?>"
                     alt="<?= h($ev['title']) ?> — Past workshop by CARE Chennai">
                <span class="event-card-badge completed">Completed</span>
              </div>
            </a>
            <div class="event-card-body">
              <div class="event-meta">
                <span class="event-meta-item">📅 <?= formatDate($ev['event_date']) ?></span>
              </div>
              <h3><a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>"><?= h($ev['title']) ?></a></h3>
              <p><?= h($ev['short_description']) ?></p>
              <div class="event-card-cta">
                <a href="<?= SITE_URL ?>/events/<?= h($ev['slug']) ?>" class="btn btn-outline">Read Recap</a>
              </div>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CTA Section (Ads-optimized) -->
<section class="section-alt events-cta">
  <div class="container text-center">
    <span class="eyebrow">Can't Wait For The Next Event?</span>
    <h2>Talk To A Counsellor Today</h2>
    <p class="lead" style="max-width:600px; margin: 0 auto 20px;">Book a private, confidential session with our expert psychologists.</p>
    <div class="cta-buttons">
      <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
      <a href="https://wa.me/<?= SITE_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">Chat on WhatsApp</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
