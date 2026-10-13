<?php
require_once __DIR__ . '/includes/db.php';
header('Content-Type: application/xml; charset=utf-8');
$today = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  <url>
    <loc><?= SITE_URL ?>/</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
    <image:image>
      <image:loc><?= SITE_URL ?>/assets/images/care-counselling-hero-banner.webp</image:loc>
      <image:title>CARE Family Counselling &amp; Childrens Wellness Center Chennai</image:title>
    </image:image>
  </url>
  <url>
    <loc><?= SITE_URL ?>/services</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/psychologists</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/events</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/career</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/contact</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>

  <!-- Service landing pages (high-value SEO) -->
  <url>
    <loc><?= SITE_URL ?>/couple-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/parenting-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/individual-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/career-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/rehab-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>
  <url>
    <loc><?= SITE_URL ?>/extramarital-counselling</loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.85</priority>
  </url>

  <?php
  $result = mysqli_query($conn, "SELECT slug, image, title, created_at FROM events ORDER BY event_date DESC");
  if ($result):
    while ($row = mysqli_fetch_assoc($result)):
  ?>
  <url>
    <loc><?= SITE_URL ?>/events/<?= htmlspecialchars($row['slug']) ?></loc>
    <lastmod><?= date('Y-m-d', strtotime($row['created_at'])) ?></lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
    <?php if ($row['image']): ?>
    <image:image>
      <image:loc><?= SITE_URL ?>/uploads/events/<?= htmlspecialchars($row['image']) ?></image:loc>
      <image:title><?= htmlspecialchars($row['title']) ?></image:title>
    </image:image>
    <?php endif; ?>
  </url>
  <?php endwhile; endif; ?>

</urlset>
