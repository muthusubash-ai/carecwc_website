<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Extra Marital Affair Counselling in Chennai | Sensitive & Confidential | CARE";
$pageDescription = "Non-judgmental counselling for extra marital affairs and infidelity issues in Chennai. Find clarity, rebuild trust, or navigate separation with dignity. Confidential sessions with expert therapists.";
$pageKeywords = "extra marital affair counselling Chennai, infidelity counselling, affair recovery therapy, marriage after infidelity, cheating spouse counselling";
$pageCanonical = SITE_URL . "/extramarital-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Extra Marital Affair Counselling</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">Extra-Marital Affairs bring intense emotional pain, confusion, and uncertainty for everyone involved. At Care Counselling & Wellness Center, we offer sensitive, non-judgmental support to help individuals and couples navigate this difficult time. Whether healing together or choosing separate paths, our counsellors guide you toward clarity, emotional stability, and long-term, sustainable solutions.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img src="<?= SITE_URL ?>/assets/images/services-extramarital.webp" alt="Extra marital affair counselling session in Chennai – a couple in a supportive therapy session with a professional counsellor at CARE" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Navigating the Pain of Infidelity</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We provide a safe, confidential space for partners to process grief, rebuild trust, and make clear decisions for the future.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="infidelity">
        <h3>Infidelity Disclosure & Crisis Support</h3>
        <p>Discovering an affair can be overwhelming and destabilizing. We provide immediate, compassionate support to help individuals and couples process shock, pain, and confusion in the first difficult days. Our counsellors create a safe, non-judgmental space to stabilize emotions, ensuring both partners feel heard before moving toward clarity, healing, and informed next steps.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="betrayed">
        <h3>Individual Counselling for the Betrayed Partner</h3>
        <p>Betrayal often brings intense grief, anger, and shattered trust. We offer dedicated one-on-one sessions to help you process these emotions safely, rebuild self-esteem, and regain emotional stability. Our goal is to help you heal at your own pace, whether you choose to rebuild the relationship or move forward independently.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="strayed">
        <h3>Individual Counselling for the Partner Who Strayed</h3>
        <p>We provide a judgment-free space to understand the deeper reasons behind the affair led to unmet needs, emotional gaps, or personal struggles. Through honest reflection, clients take genuine accountability, gain self-awareness, and develop the tools needed to make healthier choices moving forward, whether within the marriage or beyond it.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="trust">
        <h3>Trust Rebuilding & Relationship Repair</h3>
        <p>Rebuilding trust after infidelity takes structure and patience. We guide couples through practical, step-by-step exercises to restore transparency, emotional safety, and connection. With consistent effort and honest communication, many couples successfully rebuild a stronger, more resilient relationship grounded in renewed trust and mutual understanding.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 5 -->
      <div class="subservice-card" id="communication">
        <h3>Communication & Conflict Resolution Therapy</h3>
        <p>Poor communication often lies beneath emotional distance and infidelity. We teach couples healthier ways to express needs, resolve conflicts, and listen without defensiveness. These practical communication tools help address root issues, reduce recurring arguments, and create a more open, honest, and emotionally connected partnership going forward.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 6 -->
      <div class="subservice-card" id="decision">
        <h3>Decision-Making Counselling (Stay or Separate)</h3>
        <p>Deciding whether to stay together or separate is deeply personal and often overwhelming. We offer unbiased, judgment-free guidance to help couples explore both paths clearly. Our counsellors support you in making a decision aligned with your long-term emotional wellbeing, values, and future without pressure or external influence.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 7 -->
      <div class="subservice-card" id="co-parenting">
        <h3>Co-Parenting & Family Impact Counselling</h3>
        <p>When children are involved, protecting their emotional wellbeing is a priority. We help couples navigate difficult conversations, maintain stability at home, and develop healthy co-parenting strategies, whether reconciling or separating and ensuring children feel secure, loved, and shielded from unnecessary conflict during a challenging family transition.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 8 -->
      <div class="subservice-card" id="emotional">
        <h3>Emotional Affair Counselling</h3>
        <p>Emotional affairs, though non-physical, can be just as damaging to a relationship's trust and intimacy. We help couples understand the emotional void that led to the connection, address feelings of betrayal, and rebuild closeness through honest dialogue, renewed emotional investment, and stronger boundaries within the marriage.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 9 -->
      <div class="subservice-card" id="rebuilding">
        <h3>Post-Affair Marriage Rebuilding Program</h3>
        <p>For couples committed to healing, our structured multi-session program offers long-term support to rebuild the marriage from the ground up. We focus on restoring trust, intimacy, and communication while addressing underlying issues, helping couples create a stronger, more resilient relationship foundation for lasting commitment.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 10 -->
      <div class="subservice-card" id="pre-separation">
        <h3>Pre-Separation & Divorce Counselling</h3>
        <p>When reconciliation isn't the right path, we support individuals through the emotional complexities of separating with dignity. Our counselling helps minimize conflict, process grief, and navigate difficult decisions calmly and clearly, ensuring the transition is handled respectfully, especially when children or extended family are involved.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 11 -->
      <div class="subservice-card" id="self-esteem">
        <h3>Self-Esteem & Identity Rebuilding</h3>
        <p>Betrayal can deeply shake one's sense of self-worth and identity. We offer focused sessions to help you rebuild confidence, rediscover your strengths, and reconnect with who you are beyond the relationship. This empowering process supports healing and helps you move forward with renewed clarity and self-assurance.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 12 -->
      <div class="subservice-card" id="family-impact">
        <h3>Confidential Sessions for Extended Family/In-laws Impact</h3>
        <p>Affairs can strain relationships with extended family and in-laws, adding further emotional complexity. We offer sensitive, confidential guidance to help families navigate these dynamics thoughtfully reducing tension, protecting relationships where possible, and helping everyone involved manage the situation with respect, discretion, and emotional maturity.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
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
  .service-hero > .container > div {
    grid-template-columns: 1fr !important;
  }
}
</style>

<section class="section-alt text-center">
  <div class="container">
    <h2>Ready to take the next step?</h2>
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Whether you're looking to rebuild your relationship or find the strength to move forward, we are here to support you.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
