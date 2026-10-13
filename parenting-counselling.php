<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Child & Teen Counselling in Chennai | Parenting Guidance | CARE";
$pageDescription = "Chennai's trusted child psychologist for teenage & adolescent counselling, behavioural therapy, and parenting guidance. Support for ASD, ADHD, academic stress, exam anxiety, and digital addiction.";
$pageKeywords = "child psychologist Chennai, teen counselling Chennai, parenting guidance, ASD ADHD assessment, behavioural therapy children, adolescent counselling";
$pageCanonical = SITE_URL . "/parenting-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Parenting &amp; Children Counselling</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">Growing up comes with emotional ups and downs, and how a child navigates these early experiences shapes their confidence, relationships, and mental health for years to come. Parenting itself can feel just as overwhelming, filled with self-doubt, exhaustion, and unanswered questions about how best to support a child's development. Parenting and children counselling bridges this gap, offering families professional guidance to understand behaviour, manage emotions, and strengthen communication at home. Whether it's a child struggling with anxiety, a teenager facing identity challenges, or parents seeking better ways to connect, timely psychological support helps prevent small concerns from becoming lasting struggles, building emotionally healthier, more resilient families together.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-parenting.webp" alt="Child &amp; adolescent counselling in Chennai – a teenager in a supportive session with a professional child counsellor at CARE" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Comprehensive Support for Your Child's Growth</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We provide a safe, nurturing environment to help children, teens, and parents navigate developmental and emotional challenges.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="assessment">
        <h3>Kids Psychological Assessment</h3>
        <p>Every child develops differently, and it isn't always easy to tell whether a struggle is a passing phase or a deeper concern. A kids psychological assessment is essential because it identifies issues like ADHD, learning difficulties, anxiety, or developmental delays early, before they affect a child's confidence, schooling, or relationships. Using structured evaluations, behavioural observation, and psychometric tools, our child psychologists build a clear picture of a child's cognitive and emotional functioning. This clarity removes guesswork for parents and enables timely, targeted support at home and school. Early assessment isn't about labelling a child, it's about understanding them so the right help can be offered at the right time, shaping healthier long-term development.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="kids-counselling">
        <h3>Kids / Children Counselling</h3>
        <p>Children often cannot express what they feel in words, so their emotions surface as tantrums, withdrawal, or fear instead. Children counselling is important because it gives kids a safe outlet to process experiences like bullying, family changes, grief, or anxiety through play therapy, art therapy, and guided conversation. Without this support, unresolved emotions can affect a child's behaviour, self-esteem, and relationships well into adulthood. Our counsellors help children build emotional vocabulary, coping skills, and resilience at an age-appropriate pace. Involving parents where needed strengthens communication at home too. Ultimately, this counselling nurtures emotional intelligence early, giving children healthier tools to manage stress and big feelings for life.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="teenage-counselling">
        <h3>Teenage / Adolescent Counselling</h3>
        <p>Adolescence brings intense emotional, hormonal, and social changes, often leaving teenagers feeling exhausted, misunderstood, or anxious. Teenage counselling is crucial because it offers a confidential space to address academic stress, peer pressure, self-image, family conflict, or early signs of depression before they escalate. Using cognitive behavioural techniques and reflective listening, counsellors help teens understand their emotions and build healthier coping mechanisms instead of suppressing them. Left unaddressed, adolescent struggles can affect self-esteem, academic performance, and mental health long-term. This counselling also helps parents support their teen without overstepping boundaries. The result is greater emotional stability, resilience, and self-awareness during one of life's most transformative stages.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="parental-counselling">
        <h3>Parental Counselling</h3>
        <p>Parenting brings joy, but also emotional exhaustion, guilt, and self-doubt that often go unspoken. Parental counselling matters because a parent's emotional wellbeing directly shapes the home environment and a child's development. Sessions help parents manage stress and burnout, improve communication styles, and understand the psychological needs behind their child's behaviour. Without this support, unresolved parental stress can strain family relationships and affect children's emotional security. Using cognitive behavioural and mindfulness-based approaches, counsellors help parents respond to challenges with empathy rather than reaction. Investing in parental counselling doesn't just support the parent, it strengthens the entire family, creating a calmer, more connected, and emotionally secure home for everyone.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 5 -->
      <div class="subservice-card" id="behavioural" style="grid-column: 1 / -1; max-width: 800px; margin: 0 auto;">
        <h3>Behavioural Modification</h3>
        <p>Persistent behavioural issues like tantrums, defiance, or withdrawal usually stem from deeper emotional or developmental needs, not simple disobedience. Behavioural modification is important because it addresses the root cause rather than just suppressing the behaviour, preventing long-term emotional and social difficulties. Using positive reinforcement, structured routines, and cognitive behavioural techniques, this approach helps children develop healthier patterns of thinking and acting. Without intervention, unmanaged behavioural challenges can affect school performance, friendships, and family harmony. Consistency between home and school is key to lasting change, which is why parents and teachers are actively involved. This gradual, compassionate process helps children move toward calmer, more cooperative, and emotionally secure behaviour.</p>
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
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Whether you want to help your child overcome challenges or strengthen your parenting skills, our experts are here to guide you.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
