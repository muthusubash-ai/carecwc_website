<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Marriage & Couple Counselling in Chennai | Relationship Therapy | CARE";
$pageDescription = "Expert marriage counselling and couples therapy in Chennai. Rebuild trust, improve communication, resolve conflicts. Pre-marital assessments, marital problems, divorce guidance, and post-partum support.";
$pageKeywords = "marriage counselling Chennai, couple therapy Chennai, relationship counselling, pre-marital counselling, divorce guidance, marital problems, post-partum depression";
$pageCanonical = SITE_URL . "/couple-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Couple Counselling</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">Every relationship faces challenges, but with the right support, couples can navigate them together. At Care Family Counselling Center, our experienced couple therapists help partners strengthen communication, resolve conflicts, and rebuild emotional intimacy. Our compassionate, non-judgmental approach empowers couples to build a stronger, lasting relationship.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-couple.webp" alt="Couple Counselling in Chennai" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Comprehensive Relationship Support</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We provide a safe, confidential space to work through misunderstandings, emotional distance, and life transitions.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="relationship">
        <h3>Relationship Counselling</h3>
        <p>Our Psychologists helps individuals and partners work through misunderstandings, emotional distance, and recurring conflicts in a safe, confidential space. Whether you're seeking a guidance for dating relationships, family bonds, or long-term partnerships, our counsellors guide you toward healthier communication, deeper connection, and lasting emotional wellbeing.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="marital">
        <h3>Marital &amp; Family Counselling</h3>
        <p>We support couples and families in resolving conflicts, improving communication, and strengthening bonds across generations. Our family therapy services addresses sibling conflicts, in-law dynamics, parenting differences, and emotional disconnect, helping families build a harmonious home rooted in mutual understanding and trust.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="pre-marital">
        <h3>Pre-Marital Assessment &amp; Counselling</h3>
        <p>Our structured pre-marriage assessment aims to identify difference of personalities, discuss difficult expectations, values, communication styles, and other potential challenges a couple may face. Identifying them early gives an edge to decide better about their future without compromising their own values. This proactive approach equips partners with the tools needed for a healthy, resilient, and well-aligned married life ahead.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="post-partum">
        <h3>Post-Partum Depression Counselling (PPD)</h3>
        <p>A lot of Women are struggling with postpartum depression after childbirth and it is important to help the new mothers with needed counselling support to enable them to come out of it early. Our Psychologists are compassionate and nurture new mothers suffering in post-partum depression with proper counselling sessions for postnatal anxiety, mood swings, or overwhelming feelings. We help you process these emotions, rebuild confidence, and navigate the transition into motherhood with the right coping tools.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 5 -->
      <div class="subservice-card" id="divorce" style="grid-column: 1 / -1; max-width: 800px; margin: 0 auto;">
        <h3>Divorce Counselling / Guidance</h3>
        <p>Going through or planning for separation? It is important to meet Psychologists before you make further moves! Because we know it may be overwhelming and you need support and clarity!</p>
        <p style="margin-top: 10px;">At Care Family Counselling Center, our Psychologists provide compassionate, non-judgmental guidance to help individuals process grief, make clear-headed decisions, and navigate the emotional and legal complexities of divorce and separation. We also offer support for co-parenting counselling and rebuilding your sense of self as you move into this new chapter of your life.</p>
        <div style="margin-top: 24px;">
          <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline">Book an Appointment</a>
        </div>
      </div>

    </div>
  </div>
</section>

<style>
.subservices-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
}
.subservice-card {
  background: var(--white);
  padding: 40px;
  border-radius: var(--radius);
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  border-top: 4px solid var(--marigold);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.subservice-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}
.subservice-card h3 {
  color: var(--navy);
  font-size: 22px;
  margin-top: 0;
  margin-bottom: 16px;
  font-family: var(--font-display);
}
.subservice-card p {
  color: var(--slate-gray);
  line-height: 1.7;
  margin: 0;
}
@media (max-width: 768px) {
  .subservices-grid {
    grid-template-columns: 1fr;
  }
  .subservice-card[style] {
    grid-column: 1 / -1 !important;
  }
  .service-hero > .container > div {
    grid-template-columns: 1fr !important;
  }
}
</style>

<section class="section-alt text-center">
  <div class="container">
    <h2>Ready to take the next step?</h2>
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Whether you want to strengthen your bond or navigate a difficult transition, our experts are here to help.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
