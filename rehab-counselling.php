<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "De-Addiction & Rehabilitation Counselling in Chennai | CARE";
$pageDescription = "Compassionate de-addiction support in Chennai for drug, alcohol, mobile gaming, gadget, and porn addiction. Structured recovery therapy with expert psychologists. 100% confidential.";
$pageKeywords = "de-addiction Chennai, rehab counselling, drug addiction therapy, gaming addiction, mobile addiction, alcohol de-addiction Chennai";
$pageCanonical = SITE_URL . "/rehab-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Rehabilitation Counselling</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">Rehabilitation counselling helps individuals break free from addictive patterns and rebuild a balanced, healthy life. Addiction rarely begins overnight and it moves through stages: experimentation, regular use, risky use, dependence, and finally addiction, where the person loses control despite consequences. Left unaddressed, it damages relationships, careers, physical health, and mental wellbeing. Professional counselling matters because recovery isn't just about stopping a habit; it's about healing the underlying emotional triggers. Our Rehabilitation Psychologists Mr. Damodaran & Ms. Siva Priya approach combines assessment, cognitive behavioural therapy, motivational counselling, family therapy, and structured de-addiction programs, guiding each person step-by-step toward lasting recovery, self-control, and renewed confidence in everyday life.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-rehab.webp" alt="Rehabilitation Counselling in Chennai" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Reclaim Your Life &amp; Independence</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We provide comprehensive assessment and personalized therapies to help you or your loved ones overcome dependency and build lasting emotional resilience.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="assessment">
        <h3>Addiction Level Assessment</h3>
        <p>Before recovery can begin, it's essential to understand how deep the dependency runs. At Care Counselling & Wellness Center, we follow addiction level assessments using standardized psychological screening tools, structured interviews, and behavioural observation to measure the severity, frequency, and impact of the addiction on daily functioning. We evaluate physical dependence, psychological cravings, tolerance levels, withdrawal patterns, and co-occurring emotional issues like anxiety, depression, or stress. This assessment isn't just a checklist, it's the foundation for a personalised treatment plan. By identifying triggers, family history, and lifestyle stressors early, our counsellors design a recovery roadmap suited to the individual rather than a one-size-fits-all program. Regular reassessment tracks progress and adjusts therapy as needed. Whether the concern is substance use, gadget dependency, or behavioural addiction, a thorough evaluation ensures the right level of care, outpatient counselling, intensive therapy, or referral for medical detox is recommended from day one, saving time and emotional strain for the family.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="alcohol">
        <h3>Alcohol / Tobacco Addiction</h3>
        <p>Alcohol and tobacco dependency often starts as a coping mechanism for stress, peer pressure, or emotional pain, gradually turning into a physical and psychological need. Our counselling approach addresses both dimensions the biological cravings and the emotional patterns driving repeated use. Through motivational interviewing, cognitive behavioural therapy, and relapse-prevention planning, individuals learn to identify triggers, manage withdrawal discomfort, and replace harmful coping habits with healthier alternatives. We also work closely with families, since addiction often creates cycles of guilt, mistrust, and emotional exhaustion at home. Group therapy sessions offer peer support and accountability, while one-on-one counselling explores deeper issues like trauma, low self-worth, or unresolved anger that fuel the addiction. For long-term users, we coordinate with medical professionals for safe detox support. The goal is sustainable sobriety not just quitting, but rebuilding emotional resilience, restoring family trust, and helping individuals rediscover purpose and stability without dependency on alcohol or tobacco.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="gadget">
        <h3>Mobile / Gadget Addiction</h3>
        <p>Excessive screen time has quietly become one of the most common behavioural addictions today, affecting focus, sleep, relationships, and mental health. Mobile and gadget addiction counselling helps individuals especially children, teens, and young adults recognise compulsive usage patterns and understand the psychological pull behind constant notifications, social validation, and instant gratification. Our therapists Mr. Damodaran & Ms. Siva Priya use cognitive behavioural techniques, digital detox planning, and structured screen-time management to gradually reduce dependency without triggering resistance or anxiety.</p>
        <p style="margin-top: 10px;">We also explore the emotional void the device may be filling loneliness, low self-esteem, social anxiety, or family conflict. Parental counselling sessions are included, helping families set healthy boundaries without confrontation. For adults struggling with work-related device overuse, we focus on stress management and mindfulness practices to restore real-world engagement. The result is improved concentration, better sleep quality, stronger in-person relationships, and a healthier, more mindful relationship with technology without complete deprivation, but balanced, intentional use.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="gaming">
        <h3>Online Gaming Addiction</h3>
        <p>Online gaming addiction goes beyond casual play it involves compulsive gaming that interferes with studies, work, sleep, and social life, often accompanied by irritability, isolation, and emotional withdrawal when not gaming. Our counselling identifies the psychological reward loops achievement, competition, escapism that keep individuals hooked, and works to replace them with healthier sources of motivation and connection. Using cognitive behavioural therapy, impulse-control training, and structured lifestyle restructuring, we help clients regain control over time management and emotional regulation. Family counselling plays a key role, since gaming addiction often strains parent-child relationships and causes household conflict.</p>
        <p style="margin-top: 10px;">We also address underlying issues such as social anxiety, academic pressure, or depression that make virtual escape more appealing than reality. Group therapy and peer-support sessions help reduce feelings of isolation common among gamers. Recovery focuses not on eliminating gaming entirely, but on restoring balance, rebuilding real-world social skills, and reducing the emotional dependency on virtual achievement and escapism.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 5 -->
      <div class="subservice-card" id="sex-addiction">
        <h3>Porn / Sex Addiction</h3>
        <p>Porn and sex addiction carry heavy emotional weight often layered with shame, secrecy, guilt, and relationship strain making professional, confidential counselling essential. Our therapists create a non-judgmental space to explore the compulsive patterns, emotional triggers, and underlying psychological needs such as stress relief, low self-esteem, past trauma, or relationship dissatisfaction that drive the behaviour. Using cognitive behavioural therapy, impulse-control strategies, and mindfulness-based techniques, we help individuals regain control without added shame or stigma. Couples counselling is available where the addiction has affected trust and intimacy within a relationship, focusing on honest communication and rebuilding emotional connection. We also address co-occurring anxiety, depression, or compulsive behaviour patterns that often accompany this addiction. Confidentiality and empathy are central to our process, recognising how emotionally draining and isolating this struggle can feel. Recovery is gradual and personalised, aiming for healthier intimacy, restored self-respect, reduced compulsive urges, and stronger emotional and relational wellbeing over time.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 6 -->
      <div class="subservice-card" id="therapies">
        <h3>De-Addiction Therapies</h3>
        <p>Effective de-addiction combines multiple therapeutic approaches tailored to the individual's addiction type, emotional history, and life circumstances. Our Psychologists Mr. Damodaran & Ms. Siva Priya unique programs integrate cognitive behavioural therapy, motivational interviewing, group therapy, family counselling, mindfulness-based relapse prevention, and where needed, coordination with medical detox services. Each therapy targets a different layer of recovery CBT reshapes thought patterns and triggers, motivational interviewing strengthens the individual's own commitment to change, and group therapy provides shared accountability and reduces isolation. Family involvement helps rebuild trust and communication damaged during active addiction. We also focus heavily on the emotional and psychological toll addiction takes the anxiety, guilt, low self-worth, and emotional exhaustion that often linger even after physical cravings subside. Relapse-prevention planning equips individuals with practical coping strategies for high-risk situations. Our holistic, step-by-step approach ensures therapy doesn't end at abstinence it continues toward genuine emotional healing, renewed self-confidence, and long-term, sustainable recovery.</p>
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
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Recovery is a journey, and you don't have to walk it alone. Reach out to our experts today.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
