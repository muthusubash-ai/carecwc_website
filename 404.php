<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

http_response_code(404);

$pageTitle = "Page Not Found (404) | " . SITE_NAME;
$pageDescription = "The page you're looking for could not be found. Explore our online counselling services or contact us.";
$pageCanonical = SITE_URL . "/404";

include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding:80px 0; text-align:center;">
  <div class="container">
    <span class="eyebrow">Error 404</span>
    <h1 style="font-size:48px; margin-bottom:16px;">Page Not Found</h1>
    <p class="lead" style="max-width:620px; margin:0 auto 30px;">
      Sorry, the page you're looking for doesn't exist or may have been moved.
      Let's get you back on track.
    </p>
    <div class="hero-actions" style="justify-content:center; gap:15px; display:flex; flex-wrap:wrap;">
      <a href="<?= SITE_URL ?>/" class="btn btn-primary">Back to Home</a>
      <a href="<?= SITE_URL ?>/services" class="btn btn-outline">View Services</a>
      <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-gold">Book an Appointment</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
