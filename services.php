<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "All Counselling Services in Chennai | Marriage, Child, Career, Rehab | CARE";
$pageDescription = "Comprehensive counselling services in Chennai: Marriage & Couple Counselling, Child & Teen Therapy, Stress & Anxiety Support, Career Guidance, Rehabilitation, and Extra Marital Affair Counselling. Confidential online & offline sessions.";
$pageKeywords = "counselling services Chennai, therapy Chennai, marriage counselling, child therapy, career guidance, de-addiction rehab, extra marital affair, individual counselling";
$pageCanonical = SITE_URL . "/services";
$activeNav = "services";

// Legacy ?id= URLs now 301-redirect to the clean dedicated pages
// (avoids duplicate content and keeps old links working).
if (isset($_GET['id'])) {
    $allowed = [
        'couple-counselling', 'parenting-counselling', 'individual-counselling',
        'career-counselling', 'rehab-counselling', 'extramarital-counselling'
    ];
    $id = $_GET['id'];
    if (in_array($id, $allowed, true)) {
        header('Location: ' . SITE_URL . '/' . $id, true, 301);
        exit;
    }
}

$services = [
    [
        'category' => 'Couple Counselling',
        'link' => 'couple-counselling',
        'image' => 'services-couple.webp',
        'sub_services' => [
            ['name' => 'Couple Counselling', 'hash' => ''],
            ['name' => 'Relationship Counselling', 'hash' => '#relationship'],
            ['name' => 'Marital Counselling / Family Counselling', 'hash' => '#marital'],
            ['name' => 'Pre-Marital Assessment & Counselling', 'hash' => '#pre-marital'],
            ['name' => 'Post-Partum Depression Counselling', 'hash' => '#post-partum'],
            ['name' => 'Divorce Counselling / Guidance', 'hash' => '#divorce']
        ]
    ],
    [
        'category' => 'Parenting – Children Counselling',
        'link' => 'parenting-counselling',
        'image' => 'services-parenting.webp',
        'sub_services' => [
            ['name' => 'Kids Psychological Assessment', 'hash' => '#assessment'],
            ['name' => 'Kids / Children Counselling', 'hash' => '#kids-counselling'],
            ['name' => 'Teenage / Adolescent Counselling', 'hash' => '#teenage-counselling'],
            ['name' => 'Parental Counselling', 'hash' => '#parental-counselling'],
            ['name' => 'Behavioural Modification', 'hash' => '#behavioural']
        ]
    ],
    [
        'category' => 'Individual Counselling',
        'link' => 'individual-counselling',
        'image' => 'services-individual.webp',
        'sub_services' => [
            ['name' => 'Adults Psychological Assessment', 'hash' => '#assessment'],
            ['name' => 'Work Stress & Anger Management', 'hash' => '#stress'],
            ['name' => 'Anxiety Disorder & OCD Management', 'hash' => '#anxiety'],
            ['name' => 'Depression Relief Counselling', 'hash' => '#depression'],
            ['name' => 'Personality Disorder Counselling', 'hash' => '#personality'],
            ['name' => 'Single / Co-Parenting Guidance', 'hash' => '#co-parenting']
        ]
    ],
    [
        'category' => 'Life Coaching & Career Guidance',
        'link' => 'career-counselling',
        'image' => 'services-career.webp',
        'sub_services' => [
            ['name' => 'Career Options & Career Guidance', 'hash' => '#options'],
            ['name' => 'Decision Making Support', 'hash' => '#decision'],
            ['name' => 'Solution Focused Therapy', 'hash' => '#solution'],
            ['name' => 'Professional Development Guidance', 'hash' => '#professional'],
            ['name' => 'Boost Self Confidence & Motivation', 'hash' => '#confidence']
        ]
    ],
    [
        'category' => 'De-Addiction – Rehabilitation',
        'link' => 'rehab-counselling',
        'image' => 'services-rehab.webp',
        'sub_services' => [
            ['name' => 'Addiction Level Assessment', 'hash' => '#assessment'],
            ['name' => 'Alcohol / Tobacco Addiction', 'hash' => '#alcohol'],
            ['name' => 'Mobile / Gadget Addiction', 'hash' => '#gadget'],
            ['name' => 'Online Gaming Addiction', 'hash' => '#gaming'],
            ['name' => 'Porn / Sex Addiction', 'hash' => '#sex-addiction'],
            ['name' => 'De-Addiction Therapies', 'hash' => '#therapies']
        ]
    ],
    [
        'category' => 'Extra Marital Affair Counselling',
        'link' => 'extramarital-counselling',
        'image' => 'services-extramarital.webp',
        'sub_services' => [
            ['name' => 'Infidelity Disclosure & Crisis Support', 'hash' => ''],
            ['name' => 'Decision-Making Counselling', 'hash' => ''],
            ['name' => 'Emotional Affair Therapy', 'hash' => ''],
            ['name' => 'Post-Affair Marriage Rebuilding Guidance', 'hash' => ''],
            ['name' => 'Pre-Separation & Divorce Counselling', 'hash' => ''],
            ['name' => 'Co-Parenting & Family Counselling', 'hash' => '']
        ]
    ]
];

include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding:50px 0 20px;">
  <div class="container">
    <span class="eyebrow">What We Offer</span>
    <h1>Our Comprehensive Services</h1>
    <p class="lead">Every service below is delivered through confidential sessions, tailored to your emotional well-being and growth.</p>
  </div>
</section>

<section class="services-list-section">
  <div class="container">
    <?php foreach ($services as $index => $s): ?>
      <div id="service-<?= $index ?>" class="service-row fade-in-up <?= ($index % 2 !== 0) ? 'reverse' : '' ?>">
        <div class="service-image">
          <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/<?= $s['image'] ?>" alt="<?= h($s['category']) ?>" class="img-responsive">
        </div>
        <div class="service-content">
          <?php if (!empty($s['link'])): ?>
            <h2><a href="<?= SITE_URL ?>/<?= $s['link'] ?>" style="color: inherit; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--marigold)'" onmouseout="this.style.color='inherit'"><?= h($s['category']) ?></a></h2>
          <?php else: ?>
            <h2><?= h($s['category']) ?></h2>
          <?php endif; ?>
          <ul class="sub-services-list">
            <?php foreach ($s['sub_services'] as $sub): ?>
              <?php 
                $subName = is_array($sub) ? $sub['name'] : $sub;
                $subHash = is_array($sub) ? $sub['hash'] : '';
              ?>
              <?php if (!empty($s['link'])): ?>
                <li><a href="<?= SITE_URL ?>/<?= $s['link'] ?>" style="color: inherit; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--marigold)'" onmouseout="this.style.color='inherit'"><?= h($subName) ?></a></li>
              <?php else: ?>
                <li><?= h($subName) ?></li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
          <div style="display: flex; gap: 15px; margin-top: 10px;">
            <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline mt-10">Book an Appointment</a>
            <?php if (!empty($s['link'])): ?>
              <a href="<?= SITE_URL ?>/<?= $s['link'] ?>" class="btn btn-primary mt-10">View Full Details</a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="section-alt text-center fade-in-up">
  <div class="container">
    <h2>Not Sure Which Service Fits You?</h2>
    <p>Reach out and we'll help guide you to the right kind of support.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-in-up').forEach((el) => {
        observer.observe(el);
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
