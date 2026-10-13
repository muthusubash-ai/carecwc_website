<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Career Counselling & Life Coaching in Chennai | CARE Wellness Center";
$pageDescription = "Expert career guidance and life coaching in Chennai. Aptitude assessments, career transitions, work-life balance, and personal growth for students, professionals, and life-changers.";
$pageKeywords = "career counselling Chennai, life coaching Chennai, aptitude test Chennai, career guidance students, work-life balance coaching";
$pageCanonical = SITE_URL . "/career-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Life Coaching &amp; Career Guidance</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">Life Coaching and Career Guidance help individuals navigate personal and professional crossroads with clarity and confidence. In today's fast-paced world, stress, indecision, and lack of direction can affect mental wellbeing and career growth. Professional counselling bridges this gap by combining psychological insight with practical planning. Our Counsellor Mr. Damodaran uses proven methods such as Cognitive Behavioral Therapy (CBT), Solution-Focused Brief Therapy, motivational interviewing, and goal-setting frameworks, our experienced counsellors help clients identify strengths, overcome self-doubt, and make informed decisions. Whether you're choosing a career path, facing a life transition, or seeking emotional balance, structured coaching offers the tools and support needed for lasting personal and professional transformation.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-career.webp" alt="Life Coaching & Career Guidance in Chennai" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Navigating Your Path with Confidence</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We combine psychological insight with practical tools to help you overcome self-doubt, make strategic decisions, and achieve personal transformation.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="options">
        <h3>Career Options & Career Guidance</h3>
        <p>Choosing the right career path can feel overwhelming, especially with so many options and constant comparison from society, family, and peers. Our career guidance sessions combine psychometric assessment, aptitude analysis, and personality mapping to help students and professionals discover paths aligned with their true interests and strengths. Using tools rooted in cognitive and developmental psychology, our counsellors help you understand your decision-making patterns, manage career-related anxiety, and reduce emotional exhaustion caused by uncertainty. We address underlying fears, family pressure, and self-worth issues that often influence career choices, using supportive counselling techniques and reflective exercises. Sessions are available for school students, college-goers, and working professionals looking for a career switch. Whether you need clarity on choosing a stream, a course, or a job change, our structured, empathetic approach ensures you make confident, well-informed career decisions without burnout or emotional strain.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="decision">
        <h3>Decision Making Support</h3>
        <p>Struggling to make an important life or career decision? Indecision often stems from anxiety, fear of failure, or emotional overwhelm rather than a lack of options. Our decision-making support sessions use Cognitive Behavioral Techniques, values clarification exercises, and structured decision-matrix tools to help you think clearly under pressure. Our Psychologist Ms. Siva Priya helps identify emotional blocks such as people-pleasing tendencies, perfectionism, or past disappointments that cloud judgment. Our approach draws from psychological counselling principles to separate logical reasoning from emotional reactivity, empowering you to trust your own judgment. Ideal for those facing career changes, relationship decisions, relocation, or major life choices, our sessions reduce mental fatigue and decision paralysis.</p>
        <p style="margin-top: 10px;">With a calm, non-judgmental space, clients learn practical frameworks they can reuse independently in future situations building lifelong confidence in navigating uncertainty and complex personal or professional dilemmas.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="solution">
        <h3>Solution Focused Therapy</h3>
        <p>Solution-Focused Brief Therapy (SFBT) is a goal-oriented counselling approach that emphasizes strengths and future possibilities rather than dwelling on past problems. Instead of extensive analysis of what went wrong, our therapists help clients identify what's already working and build practical, achievable steps forward. This method is especially effective for individuals experiencing burnout, workplace stress, relationship conflict, or emotional exhaustion, offering quicker relief than traditional long-term therapy models. Through techniques like the "miracle question," scaling exercises, and exception-finding, clients gain a renewed sense of control and hope. Our licensed therapists Mr. Damodaran & Ms. Siva Priya creates a supportive, judgment-free environment to help you set realistic goals and track progress session by session. This approach suits busy professionals and students who want meaningful change without prolonged commitment, addressing emotional drain, low motivation, and stress with practical, evidence-based psychological tools.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="professional">
        <h3>Professional Development Guidance</h3>
        <p>Professional growth isn't just about skills. It's deeply tied to mindset, confidence, and emotional resilience. Our professional development guidance combines career coaching with psychological support to help you handle workplace stress, imposter syndrome, and performance anxiety. Through structured sessions, we help identify limiting beliefs, communication gaps, and leadership blocks that may be holding you back. Techniques from cognitive behavioral coaching and strength-based counselling are used to build self-awareness and strategic career thinking. We also address emotional burnout common among working professionals, offering coping strategies to restore motivation and focus. Whether you're preparing for a promotion, switching industries, improving workplace relationships, or building leadership skills, our experienced counsellors Mr. Damodaran & Ms. Siva Priya offers personalized guidance. This holistic approach ensures your professional growth is supported by strong emotional and psychological foundations, not just technical competence leading to sustainable long-term career success.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 5 -->
      <div class="subservice-card" id="confidence" style="grid-column: 1 / -1; max-width: 800px; margin: 0 auto;">
        <h3>Boost Self Confidence & Motivation</h3>
        <p>Low self-confidence and motivation often stem from past failures, comparison, criticism, or unresolved emotional patterns. Our confidence-building sessions use a blend of cognitive behavioral therapy, positive psychology, and motivational counselling techniques to help you reframe negative self-talk and build a resilient mindset. Our Counsellors Mr. Damodaran & Ms. Siva Priya works on identifying root causes of self-doubt whether from childhood experiences, workplace setbacks, or social pressures—and replace them with empowering thought patterns. Practical tools like goal visualization, affirmation practices, and behavioral activation are used to rebuild motivation gradually and sustainably. This process also helps manage emotional exhaustion and anxiety that often accompany low confidence. Ideal for students, job-seekers, and professionals facing self-esteem challenges, our sessions foster genuine, lasting change rather than temporary motivation boosts. With a compassionate, structured approach, clients leave with practical tools to maintain confidence and drive long after therapy ends.</p>
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
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Whether you want to overcome stress or navigate personal struggles, our experts are here to guide you.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
