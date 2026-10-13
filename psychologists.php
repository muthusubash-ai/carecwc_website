<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Top Psychologists in Chennai | Marriage & Child Counsellors | CARE";
$pageDescription = "Meet Chennai's trusted psychologists — Siva Priya Selvarajan (Marriage & Couples) and G Damodaran (Child & Adolescent). Certified therapists with proven expertise in relationship, family, and behavioural counselling.";
$pageKeywords = "psychologist in Chennai, marriage counsellor Chennai, child psychologist Chennai, family therapist, Siva Priya Selvarajan, G Damodaran, CARE counsellors";
$pageCanonical = SITE_URL . "/psychologists";
$activeNav = "psychologists";

$pageSchema = [[
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => "Siva Priya Selvarajan",
    "jobTitle" => "Marriage & Relationship Counsellor",
    "worksFor" => ["@type" => "Organization", "name" => SITE_NAME],
    "knowsAbout" => ["Marriage Counselling", "Couples Therapy", "Individual Counselling", "Divorce Guidance"]
], [
    "@context" => "https://schema.org",
    "@type" => "Person",
    "name" => "G Damodaran",
    "jobTitle" => "Child & Behavioural Counsellor",
    "worksFor" => ["@type" => "Organization", "name" => SITE_NAME],
    "knowsAbout" => ["Child Counselling", "Adolescent Counselling", "Behavioural Therapy", "Parent-Child Dynamics"]
]];

include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding:24px 0 8px;">
  <div class="container">
    <span class="eyebrow">Our Team</span>
    <h1>Meet Our Psychologists</h1>
  </div>
</section>

<section>
  <div class="container">
    <div class="team-grid">
      <div class="profile">
        <div class="profile-header">
          <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/siva-priya.webp" alt="Siva Priya Selvarajan - Marriage Counsellor Chennai">
          <div class="profile-info">
            <h2 class="profile-name">Siva Priya Selvarajan <span class="degree">MSc., PGDRP.,</span></h2>
            <div class="specialties">
              <span>Marriage Counselling</span>
              <span>Relationship &amp; Couples Therapy</span>
              <span>Individual Counselling</span>
              <span>Extra-Marital Affair Guidance</span>
              <span>Divorce Process Guidance</span>
              <span>Life Transitions</span>
            </div>
          </div>
        </div>
        <div class="profile-content">
          <p>Mrs. Siva Priya is our trusted psychologist and marriage counsellor in Chennai, known for her calm, patient, and deeply attentive approach to therapy. As one of the leading relationship counsellors in Pallikaranai, Chennai, she works with individuals and couples navigating strained marriages, personal upheaval, and relationship conflicts — helping them rebuild trust, communication, and emotional connection.</p>
          <blockquote>
            Clients seeking marriage counselling in Chennai consistently describe Mrs. Siva Priya as a non-judgmental listener who never rushes to conclusions. She takes time to understand both perspectives before offering guidance, helping couples and individuals recognize not just their immediate problems but the deeper emotional patterns driving them.
          </blockquote>
          <p style="margin-top:14px;">Whether you're looking for pre-marital counselling, couples therapy, or support through a difficult life transition, she offers a safe, confidential online space where you'll feel genuinely heard. She also handles extra-marital affair issues with complete confidentiality and compassion, guiding clients sensitively toward long-term solutions.</p>
        </div>
      </div>

      <div class="profile">
        <div class="profile-header">
          <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/damodaran.webp" alt="G Damodaran - Child Psychologist Chennai">
          <div class="profile-info">
            <h2 class="profile-name">G Damodaran <span class="degree">MSc., PGDRP.,</span></h2>
            <div class="specialties">
              <span>Child &amp; Adolescent Counselling</span>
              <span>Behavioural Therapy</span>
              <span>Parent-Child Dynamics</span>
              <span>Stress, Anxiety &amp; Depression Counselling</span>
              <span>Communication &amp; Family Dynamics</span>
            </div>
          </div>
        </div>
        <div class="profile-content">
          <p>Mr. Damodaran is our dedicated child psychologist and behavioural counsellor in Chennai, specializing in helping children and teenagers overcome emotional and behavioural challenges. As a sought-after child counsellor in Pallikaranai, Chennai, he works closely with parents to identify the root causes of a child's struggles and build a clear, practical path toward lasting improvement.</p>
          <blockquote>
            Parents searching for child behavioural therapy describe Mr. Damodaran as an excellent listener who takes their concerns seriously from the first session. Rather than quick fixes, he works steadily toward sustainable solutions, with many families reporting meaningful improvement within just a few sessions.
          </blockquote>
          <p style="margin-top:14px;">He often identifies underlying family dynamics or home-environment factors contributing to a child's struggles and addresses them holistically. For individuals seeking support for stress, anxiety, depression, and personality-related concerns, Mr. Damodaran offers a calm, non-judgmental presence and helps clients build practical coping strategies to regain emotional balance.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
// ---------- Client testimonials (Google reviews) — 5 per psychologist ----------
$reviewsByPsych = [
    'Siva Priya Selvarajan' => [
        ['name' => 'Ashok Kumar', 'service' => 'Individual Counselling', 'text' => "I had a very positive experience with Siva Priya mam. She is kind, patient, and truly dedicated to helping people. She creates a comfortable and supportive environment where you feel heard, understood, and respected. Her counselling sessions were professional and insightful, and helped me gain clarity, confidence, and a better perspective. I sincerely appreciate her empathy, guidance, and genuine commitment to her clients' well-being. I highly recommend Siva Priya ma'am to anyone looking for compassionate, professional, and effective counselling support. Thank you, ma'am, for your care and encouragement."],
        ['name' => 'Priya Raghavan', 'service' => 'Marriage Counselling', 'text' => "We underwent marriage counselling with Siva Priya mam for the past 5 months, and the experience brought a very positive change in our relationship and family life. She patiently listened to both of us and helped us understand each other with great care. She even encouraged me to regain the confidence to resume my career. We are very grateful for her support."],
        ['name' => 'Swathy ArunKumar', 'service' => 'Individual Counselling', 'text' => "I reached out to Siva Priya ma'am during a period of significant transition. She listens with an objective, non-judgmental ear and helped me break down old, limiting beliefs, replacing them with newfound confidence. I walked away feeling grounded, validated, and finally in control of my next steps."],
        ['name' => 'Vivek Comwit', 'service' => 'Relationship Counselling', 'text' => "The session was incredible and expanded my thought process. She was so patient to listen to everything before answering. Instead of simply giving answers, she provided the foundation behind the problems in my relationship. Every couple, before getting married, should have one session with her."],
        ['name' => 'Hariprabha Ayanchetty', 'service' => 'Couple Counselling', 'text' => "Went for couple counselling — a great experience. She understands problems at the base without any bias and is a wonderful listener. She taught us how to escape the drama triangle and gave us strategies to be better. After one year: I can see a bolder me who sets healthy boundaries."],
        ['name' => 'Samita Bej', 'service' => 'Couple Counselling', 'text' => "We were having many conflicts in our family life and I had tried many different ways to resolve them. When nothing worked, I finally looked for counselling and searched a lot — then I found Siva Priya mam. After our very first discussion she understood our conflicts and suggested a few very simple steps to follow, and they are working for us. She listens to everything and finds the root cause to resolve it. Thank you so much mam — I believe this was the hidden path I was finally looking for. I also felt relieved that I could talk in Hindi, my mother tongue. It was a great relief!"],
    ],
    'G Damodaran' => [
        ['name' => 'Karthikeyan K.', 'service' => 'Depression Counselling', 'text' => "I had three sessions with Mr. Damodaran for depression while going through the divorce process. He was extremely patient and listened intently to everything I said. He offered suggestions to help me overcome my depression, which I have started practising. I will surely recommend him."],
        ['name' => 'Anandhan', 'service' => 'Child Counselling', 'text' => "I went for my 14-year-old's counselling for behaviour issues. Damodaran sir listened to my concerns clearly and helped my child overcome them. He also identified underlying family dynamics that were adding to the problem. Our home is peaceful now after years of struggle — and very reasonable too."],
        ['name' => 'Kavitha A.', 'service' => 'Marriage Counselling', 'text' => "I went for marriage counselling with Ms. Siva Priya mam and Damodaran sir. The sessions helped resolve the hurt between us and clarified the behaviours each of us expects from the other, leading to real closure. Overall, excellent counselling."],
        ['name' => 'Gokul S. Nair', 'service' => 'Career Guidance', 'text' => "I had a career guidance session with Dr. Damodaran and I am immensely grateful. His professional, empathetic approach was tailored to my needs. He guided me through a self-assessment to pinpoint my strengths and recommended practical courses. The session was transformative — I highly recommend him."],
        ['name' => 'David Samuel', 'service' => 'Work-Life Balance', 'text' => "I visited CARE with work-life balance issues and constant frustration. After my sessions with Mr. Damodaran, things changed — I understood that work-life balance is about separating work and play and prioritising my roles. Now I see things differently and enjoy what I do!"],
        ['name' => 'Gokilan', 'service' => 'Relationship Counselling', 'text' => "Thank you Damodaran sir for your valuable time. The session was wonderful and full of positive vibes created by you. I felt great while setting goals and gaining clarity about my career and how to implement it on point. Damodaran sir encouraged me to learn new things and stay positive as a person, and shared practical habits to maintain it — which I happily accept and will work on. Thank you CARE Center!"],
    ],
];
$googleSvg = '<svg viewBox="0 0 24 24" width="18" height="18"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.27-4.74 3.27-8.1z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23z"/><path fill="#FBBC05" d="M5.84 14.1a6.6 6.6 0 0 1 0-4.2V7.06H2.18a11 11 0 0 0 0 9.88l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.06l3.66 2.84C6.71 7.31 9.14 5.38 12 5.38z"/></svg>';
?>
<section class="section-alt" style="padding-top:16px;">
  <div class="container">
    <div class="section-header center">
      <span class="eyebrow">Testimonials</span>
      <h2>What Our Clients Say</h2>
      <p class="lead" style="max-width:640px;margin:0 auto;">Real, verified 5-star Google reviews from families and individuals we've had the privilege to support.</p>
    </div>

    <div class="reviews-grid">
      <?php foreach ($reviewsByPsych as $psychName => $reviews): ?>
        <h3 class="review-col-title"><span><?= h($psychName) ?></span></h3>
        <?php foreach ($reviews as $t): ?>
        <div class="review-box">
          <div class="rb-author">
            <span class="rb-avatar"><?= h(mb_substr($t['name'], 0, 1)) ?></span>
            <span class="rb-meta">
              <strong><?= h($t['name']) ?></strong>
              <small><?= h($t['service']) ?></small>
            </span>
            <span class="rb-google" title="Google Review"><?= $googleSvg ?></span>
          </div>
          <span class="rb-stars" aria-label="5 out of 5 stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <p class="rb-text"><?= h($t['text']) ?></p>
        </div>
        <?php endforeach; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section-alt text-center">
  <div class="container">
    <h2>Book a Session With Our Team</h2>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
