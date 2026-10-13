<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="index, follow">
<meta name="theme-color" content="#213E65">
<link rel="icon" type="image/png" href="<?= SITE_URL ?>/assets/images/favicon.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= SITE_URL ?>/assets/images/apple-touch-icon.png">

<!-- Preconnect to Google Fonts for faster first paint -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<!-- Preload hero image on homepage (LCP optimization) -->
<?php if (($activeNav ?? '') === 'home'): ?>
<link rel="preload" as="image" href="<?= SITE_URL ?>/assets/images/care-counselling-hero-banner.webp" fetchpriority="high">
<?php endif; ?>

<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css?v=<?= @filemtime(__DIR__ . '/../assets/css/style.css') ?: '2.3' ?>">
<?php
// Every page must set these before including header.php
renderSeoHead(
    $pageTitle ?? SITE_NAME,
    $pageDescription ?? "Marriage, family & child counselling in Chennai — confidential, compassionate, evidence-based.",
    $pageCanonical ?? cleanUrl(SITE_URL . $_SERVER['REQUEST_URI']),
    $pageSchema ?? []
);
?>
</head>
<body>

<a href="#main-content" class="skip-link">Skip to content</a>

<header class="site-header">
  <div class="container nav-wrap">
    <a href="<?= SITE_URL ?>/" class="brand">
      <img src="<?= SITE_URL ?>/assets/images/care-family-counselling-logo.png" alt="CARE Family Counselling and Children's Wellness Center logo, Chennai" width="440" height="65" class="img-responsive" fetchpriority="high">
    </a>

    <button class="nav-toggle" aria-label="Toggle menu" aria-expanded="false">&#9776;</button>

    <ul class="nav-links">
      <li><a href="<?= SITE_URL ?>/" class="<?= ($activeNav ?? '') === 'home' ? 'active' : '' ?>">Home</a></li>
      <li><a href="<?= SITE_URL ?>/psychologists" class="<?= ($activeNav ?? '') === 'psychologists' ? 'active' : '' ?>">Psychologists</a></li>
      <li class="has-dropdown">
        <a href="<?= SITE_URL ?>/services" class="<?= ($activeNav ?? '') === 'services' ? 'active' : '' ?>">Services <span class="caret">&#9662;</span></a>
        <ul class="dropdown">
          <li><a href="<?= SITE_URL ?>/couple-counselling">Couple Counselling</a></li>
          <li><a href="<?= SITE_URL ?>/parenting-counselling">Parenting Counselling</a></li>
          <li><a href="<?= SITE_URL ?>/individual-counselling">Individual Counselling</a></li>
          <li><a href="<?= SITE_URL ?>/career-counselling">Life Coaching &amp; Career</a></li>
          <li><a href="<?= SITE_URL ?>/rehab-counselling">Rehabilitation Counselling</a></li>
          <li><a href="<?= SITE_URL ?>/extramarital-counselling">Extra Marital Affair</a></li>
        </ul>
      </li>
      <li><a href="<?= SITE_URL ?>/events" class="<?= ($activeNav ?? '') === 'events' ? 'active' : '' ?>">Events</a></li>
      <li><a href="<?= SITE_URL ?>/career" class="<?= ($activeNav ?? '') === 'career' ? 'active' : '' ?>">Career</a></li>
      <li><a href="<?= SITE_URL ?>/contact" class="<?= ($activeNav ?? '') === 'contact' ? 'active' : '' ?>">Contact Us</a></li>
      <li class="mobile-book"><a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book Appointment</a></li>
    </ul>

    <div class="nav-cta">
      <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book Appointment</a>
    </div>
  </div>
</header>

<main id="main-content">
