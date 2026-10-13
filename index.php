<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Best Counselling Psychologists in Chennai: Confidential & Non-Judgemental";
$pageDescription = "Care counselling center provides online and offline therapy sessions for Relationship Issues, Marital Problems, Stress, Anxiety, Depression, Teen & Adult Behavioural Issues including De-addiction Therapies. Also guided for Divorce Process and Extra Marital Affair Issues.";
$pageKeywords = "best counselling psychologist Chennai, marriage counselling, family therapy Chennai, relationship counselling, stress anxiety depression therapy, teen counselling, de-addiction, extra marital affair, CARE Pallikaranai, online counselling Chennai";
$pageCanonical = SITE_URL . "/";
$activeNav = "home";

$faqCategories = [
    ['title' => 'Location, Hours & Appointments', 'items' => [
        ['q' => 'Where is CARE Counselling & Wellness Center located?', 'a' => "We are located in Kamakoti Nagar, Pallikaranai, Chennai – 600100, Tamil Nadu, India. You can easily find us via the major local landmarks in the Pallikaranai area."],
        ['q' => 'What are your operating hours?', 'a' => "Our center is open all 7 days of the week from 10:30 AM to 8:30 PM, including weekends (Saturday & Sunday), to accommodate working professionals and students."],
        ['q' => 'Do I need to book an appointment in advance?', 'a' => "Yes, we highly recommend booking an appointment in advance to ensure that a counsellor is available for you and to minimize waiting times."],
        ['q' => 'How can I schedule an appointment?', 'a' => "You can book an appointment by calling our front desk directly, messaging us via WhatsApp, or filling out the contact form on our website."],
        ['q' => 'Is CARE Counselling fully offline or online?', 'a' => "We conduct both modes of counselling (offline & online) as per the client's convenience & preference. Besides in-person visits at our Pallikaranai center, we provide secure online video consultations and tele-counselling for clients who cannot travel. Note: We preferably suggest an offline session at the start to understand & guide you better, and may continue online for follow-up sessions."],
    ]],
    ['title' => 'Medication, Language & Session Duration', 'items' => [
        ['q' => 'Do you provide psychiatric medication or prescriptions?', 'a' => "No, our center focuses on psychotherapy, counselling, and mind-body wellness interventions. If your condition requires medication, we can refer you to a trusted external psychiatrist."],
        ['q' => 'In what languages are the counselling sessions conducted?', 'a' => "Sessions can be conducted comfortably in Tamil, Hindi and English, ensuring you can express your thoughts without any language barrier."],
        ['q' => 'What is the duration of a session? How long can I talk with the counsellor?', 'a' => "A standard counselling session is usually 60 minutes (1 hour). Since we understand not everyone can stick to this time, we follow a Rush-Free model — no back-to-back appointments for our counsellors — and allow you to talk even if the hour is extended. We DON'T terminate a session due to time constraints or office-hour restrictions."],
        ['q' => 'How many sessions will I need to see results?', 'a' => "The number of sessions depends entirely on the individual's needs and the complexity of the concern. Some clients see progress in 2–3 sessions, while others benefit from long-term therapy."],
    ]],
    ['title' => 'Our Services | Therapeutic Approaches', 'items' => [
        ['q' => 'What types of counselling services do you provide?', 'a' => "We provide all types of counselling services, including individual therapy, relationship counselling, family therapy, child and adolescent guidance, and corporate wellness sessions."],
        ['q' => 'Do you offer marriage and relationship counselling?', 'a' => "Yes, we provide specialized couples and marriage counselling to help partners resolve conflicts, improve communication, and rebuild trust."],
        ['q' => 'Can you help children and teenagers with academic or behavioural issues?', 'a' => "Yes, our child and adolescent counselling covers academic stress, behavioural challenges, peer pressure, exam anxiety, and digital addiction."],
        ['q' => 'Do you provide corporate wellness or workplace stress management?', 'a' => "Yes, we offer tailored corporate wellness programs, stress management workshops, and employee assistance counselling for organizations."],
        ['q' => 'What therapeutic approaches do your counsellors use?', 'a' => "Our professionals use evidence-backed modalities tailored to your goals, including Cognitive Behavioural Therapy (CBT), Mindfulness-Based Therapy, Solution-Focused Therapy (SFBT), Dialectical Behaviour Therapy (DBT), Rational Emotive Behavioural Therapy (REBT), and Person-Centered / Humanistic approaches."],
    ]],
    ['title' => 'Confidentiality & Privacy', 'items' => [
        ['q' => 'Will my personal details and session discussions remain confidential?', 'a' => "Absolutely yes. Client confidentiality is our highest priority. Everything discussed within your session remains strictly between you and your counsellor, protected by professional ethics."],
        ['q' => 'Are there any exceptions to the confidentiality rule?', 'a' => "Confidentiality is only breached if there is an imminent risk of harm to yourself or someone else, or if required by a court of law. Your counsellor will discuss this protocol during your first visit."],
        ['q' => 'Can a family member find out what I discussed in my individual session?', 'a' => "No, we do not share any session details with family members or third parties without your explicit written consent — except in the case of minors, where general progress is shared with parents, or if any serious concern (such as suicidal thoughts or substance use) is identified during the sessions."],
    ]],
    ['title' => 'Your First Session', 'items' => [
        ['q' => 'Should I prepare for my first appointment? What should I expect?', 'a' => "No special preparation is required. Just bring any relevant past psychological or medical reports (if applicable) and try to arrive 10 minutes early to fill out basic intake forms. The initial session is mostly an assessment where the counsellor learns about your history, discusses current challenges, and collaborates with you to set goals for future therapy."],
        ['q' => "Can I choose or change my counsellor if I don't feel a proper connection?", 'a' => "Yes, a strong therapeutic bond is essential for successful therapy. If you feel you are not connecting well with your assigned counsellor, you can request our care coordinator for a transition to another professional."],
    ]],
    ['title' => 'Pricing & Policies', 'items' => [
        ['q' => 'What are the charges for a counselling session?', 'a' => "Our fees vary based on the service, number of sessions & session duration. Since everyone's problem is different, we can't fix a single cost that fits everyone. For exact up-to-date pricing, please contact our front desk directly or WhatsApp us at +91 99658 55184."],
        ['q' => 'What is your cancellation or rescheduling policy?', 'a' => "We request that you notify us at least 24 hours in advance if you need to cancel or reschedule your slot, so we can offer the time to another client in need."],
        ['q' => 'What modes of payment do you accept?', 'a' => "We accept all major payment modes, including UPI (GPay / PhonePe), Net Banking, and cash."],
        ['q' => 'Can I claim insurance for my counselling sessions?', 'a' => "Mental health insurance coverage depends on your specific insurance provider and policy. We can provide you with an official invoice and receipt to submit for reimbursement claims."],
    ]],
];

// Flatten for FAQ schema (SEO)
$faqs = [];
foreach ($faqCategories as $cat) { foreach ($cat['items'] as $it) { $faqs[] = $it; } }

$pageSchema = [ localBusinessSchema(), faqSchema($faqs) ];

include __DIR__ . '/includes/header.php';
?>

<section class="hero-image-section">
  <h1 style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); border: 0;">We CURE you with CARE - Family Counselling in Chennai</h1>
  <div class="hero-grid">
    <!-- Left: Banner (800x300 / 8:3) -->
    <div class="hero-banner-wrapper">
      <img src="<?= SITE_URL ?>/assets/images/care-counselling-hero-banner.webp" alt="CARE Family Counselling — Stronger Minds, Happier Families. Counselling in Chennai" width="2172" height="724" fetchpriority="high" decoding="async">

      <!-- Clickable Areas (scale proportionally with the banner) -->
      <!-- Book Appointment Button -->
      <a href="<?= SITE_URL ?>/contact#booking" aria-label="Book an Appointment" class="hero-link" style="top: 85%; left: 52%; width: 18%; height: 11%; border-radius: 50px;"></a>
      <!-- Phone/WhatsApp Button -->
      <a href="https://wa.me/<?= SITE_WHATSAPP ?>" aria-label="WhatsApp Us" target="_blank" rel="noopener" class="hero-link" style="top: 85%; left: 74%; width: 17%; height: 11%; border-radius: 50px;"></a>
    </div>

    <!-- Right: Services Panel (headings only) -->
    <div class="hero-services-panel">
      <h3>Our Core Services</h3>
      <ul class="hero-services-list">
        <li><a href="<?= SITE_URL ?>/couple-counselling"><span class="svc-star">★</span> Couple / Marital Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/couple-counselling"><span class="svc-star">★</span> Pre-Marital Assessment &amp; Guidance</a></li>
        <li><a href="<?= SITE_URL ?>/parenting-counselling"><span class="svc-star">★</span> Children / Teen Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/parenting-counselling"><span class="svc-star">★</span> Parental Guidance / Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/extramarital-counselling"><span class="svc-star">★</span> Extra Marital Affair Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/couple-counselling"><span class="svc-star">★</span> Post-Partum Depression Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/couple-counselling"><span class="svc-star">★</span> Divorce Counselling / Guidance</a></li>
        <li><a href="<?= SITE_URL ?>/individual-counselling"><span class="svc-star">★</span> Stress, Depression, Anger Management</a></li>
        <li><a href="<?= SITE_URL ?>/parenting-counselling"><span class="svc-star">★</span> ASD, ADHD Assessment &amp; Counselling</a></li>
        <li><a href="<?= SITE_URL ?>/career-counselling"><span class="svc-star">★</span> Career Options &amp; Career Guidance</a></li>
        <li><a href="<?= SITE_URL ?>/rehab-counselling"><span class="svc-star">★</span> Drug De-Addiction - Rehab Guidance</a></li>
        <li><a href="<?= SITE_URL ?>/rehab-counselling"><span class="svc-star">★</span> Mobile / Online Gaming De-Addiction</a></li>
      </ul>
    </div>
  </div>
</section>

<section class="about-section">
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">Who We Are</span>
      <h2>Chennai's Trusted Counselling Center</h2>
    </div>

    <div class="about-content">
      <p>CARE Counselling & Wellness Center is Chennai's trusted destination for compassionate, science-backed mental health support. Our team of experienced psychologists and counsellors combines years of counselling expertise with a deep understanding of the emotional and cultural realities of life in India. We help clients navigate challenges within a familiar, relatable context, creating a warm, confidential environment where every client feels heard, respected, and empowered to grow. As a leading counselling center in Chennai, we offer a comprehensive range of services including Relationship Counselling, Couple Counselling & Therapies, Marriage Counselling, Parental Counselling, Children's Counselling, Family Counselling, Pre-Marital and Post-Marital Counselling, Stress Management, Anger Management, Teenage and Adolescent Counselling, Behavioural Psychology & Therapy, Work-Life Balance Coaching, and Motivational Sessions.</p>

      <p>We also provide sensitive, non-judgmental guidance for individuals and couples dealing with extra-marital affairs, helping them work towards long-term, sustainable solutions with dignity and care. We believe every individual has the capacity to thrive when they learn to ask themselves the right questions at the right time. Our goal is to help clients build this self-awareness into a lifelong practice — guiding them toward a healthier, more fulfilling way of life, one step at a time.</p>
    </div>
  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">Why Choose Us</span>
      <h2>A Space Built On Trust</h2>
    </div>
    <div class="grid grid-6">
      <div class="feature"><div class="icon-circle">🎓</div><h3>Qualified &amp; Experienced</h3><p>Certified psychologists with proven expertise.</p></div>
      <div class="feature"><div class="icon-circle">🔒</div><h3>Confidentiality Maintained</h3><p>Your privacy is our priority.</p></div>
      <div class="feature"><div class="icon-circle">🤝</div><h3>Non-Judgmental Process</h3><p>We listen. We don't judge.</p></div>
      <div class="feature"><div class="icon-circle">📋</div><h3>Personalized Care Plans</h3><p>Tailored plans made for you.</p></div>
      <div class="feature"><div class="icon-circle">🧘</div><h3>Holistic Approach</h3><p>A blend of psychology, mindfulness &amp; wellness tools.</p></div>
      <div class="feature"><div class="icon-circle">💻</div><h3>Online Counselling</h3><p>Convenience &amp; Care for Out-Station Clients.</p></div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">What We Offer</span>
      <h2>Our Services</h2>
    </div>
    <div class="grid grid-3">
      <a href="<?= SITE_URL ?>/services#service-0" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-couple.webp" alt="Couple Counselling">
        <div class="body">
          <h3>Couple Counselling</h3>
          <p>Relationship & Marital Counselling, Pre-Marital & Post-Partum support.</p>
        </div>
      </a>
      <a href="<?= SITE_URL ?>/services#service-1" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-parenting.webp" alt="Child &amp; adolescent counselling in Chennai – a teenager in a supportive session with a professional child counsellor at CARE">
        <div class="body">
          <h3>Parenting & Children</h3>
          <p>Kids & Teenage Counselling, Parental Guidance and Behavioural Modification.</p>
        </div>
      </a>
      <a href="<?= SITE_URL ?>/services#service-2" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-individual.webp" alt="Individual counselling session in Chennai – a man in a supportive one-on-one therapy session with a professional counsellor at CARE">
        <div class="body">
          <h3>Individual Counselling</h3>
          <p>Work Stress, Anger, Anxiety, OCD Management & Depression Relief.</p>
        </div>
      </a>
      <a href="<?= SITE_URL ?>/services#service-3" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-career.webp" alt="Life Coaching & Career Guidance">
        <div class="body">
          <h3>Life Coaching & Career</h3>
          <p>Career Options, Decision Making, and Professional Development Guidance.</p>
        </div>
      </a>
      <a href="<?= SITE_URL ?>/services#service-4" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-rehab.webp" alt="Rehabilitation Counselling">
        <div class="body">
          <h3>Rehabilitation Counselling</h3>
          <p>De-Addiction Therapies for Alcohol, Gaming, Mobile and specific addictions.</p>
        </div>
      </a>
      <a href="<?= SITE_URL ?>/services#service-5" class="event-card hover-lift" style="text-decoration: none; color: inherit;">
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-extramarital.webp" alt="Extra marital affair counselling session in Chennai – a couple in a supportive therapy session with a professional counsellor at CARE">
        <div class="body">
          <h3>Extra Marital Affair Counselling</h3>
          <p>Crisis Support, Emotional Therapy, and Post-Affair Marriage Rebuilding.</p>
        </div>
      </a>
    </div>
    <p class="text-center" style="margin-top:30px;"><a href="<?= SITE_URL ?>/services" class="btn btn-outline">View All Services</a></p>
  </div>
</section>

<section class="section-alt">
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">Common Questions</span>
      <h2>Frequently Asked Questions</h2>
    </div>
    <div class="faq-grid">
      <?php foreach ($faqCategories as $cat): ?>
      <details class="faq-cat">
        <summary><span class="faq-cat-icon"></span><span class="faq-cat-title"><?= h($cat['title']) ?></span></summary>
        <div class="faq-cat-body">
          <?php foreach ($cat['items'] as $item): ?>
          <div class="faq-qa">
            <h4><?= h($item['q']) ?></h4>
            <p><?= h($item['a']) ?></p>
          </div>
          <?php endforeach; ?>
        </div>
      </details>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section>
  <div class="container text-center">
    <h2>Ready to talk to someone who understands?</h2>
    <p>Book your confidential session today.</p>
    <div class="hero-actions" style="justify-content:center;">
      <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
      <a href="https://wa.me/<?= SITE_WHATSAPP ?>" class="btn btn-whatsapp" target="_blank" rel="noopener">WhatsApp Us</a>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
