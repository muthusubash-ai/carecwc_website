<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Individual Counselling in Chennai | Anxiety, Depression, Stress Therapy | CARE";
$pageDescription = "Personalized therapy in Chennai for anxiety, depression, OCD, work stress, and anger management. Confidential one-on-one sessions with certified psychologists. Book your appointment today.";
$pageKeywords = "individual therapy Chennai, anxiety counselling, depression treatment, stress management, OCD therapy, anger management Chennai";
$pageCanonical = SITE_URL . "/individual-counselling";
$activeNav = "services";

include __DIR__ . '/includes/header.php';
?>

<!-- Service Hero Section -->
<section class="service-hero" style="background: var(--light-gray); padding: 46px 0 26px;">
  <div class="container">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: center;">
      <div>
        <span class="eyebrow">Our Services</span>
        <h1 style="color: var(--navy); margin-bottom: 20px; font-size: 42px;">Individual Counselling</h1>
        <p style="font-size: 18px; line-height: 1.6; color: var(--slate-gray);">At Care Counselling & Wellness Center, our way of Individual Counselling is always personalized therapeutic approach where our qualified psychologists, works one-on-one with you to understand and manage emotional, behavioural, and mental health concerns. Life pressures, career stress, relationship conflicts, anxiety, low mood, or identity struggles are often build up silently and affect wellbeing, relationships, and daily functioning. Individual counselling matters because it offers a confidential, judgment-free environment to process feelings, build coping skills, and gain clarity. Therapists use evidence-based approaches such as Cognitive Behavioural Therapy (CBT), Rational Emotive Behaviour Therapy (REBT), Mindfulness-Based Therapy, Dialectical Behavioural Therapy (DBT), Psychodynamic Therapy, and Solution-Focused Brief Therapy (SFBT), tailored to each individual's unique psychological needs and goals.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary" style="margin-top: 24px;">Book an Appointment</a>
      </div>
      <div>
        <img loading="lazy" decoding="async" src="<?= SITE_URL ?>/assets/images/services-individual.webp" alt="Individual counselling session in Chennai – a man in a supportive one-on-one therapy session with a professional counsellor at CARE" style="width: 100%; height: auto; max-width: 500px; border-radius: var(--radius); box-shadow: var(--shadow); display: block; margin: 0 auto;">
      </div>
    </div>
  </div>
</section>

<!-- Sub Services Section -->
<section style="padding: 40px 0;">
  <div class="container">
    <div style="text-align: center; max-width: 700px; margin: 0 auto 50px;">
      <h2 style="color: var(--navy); font-size: 32px; margin-bottom: 16px;">Comprehensive Personal Support</h2>
      <p style="color: var(--slate-gray); font-size: 17px;">We provide a safe, confidential space to work through anxiety, stress, and emotional struggles, guiding you toward lasting psychological growth.</p>
    </div>

    <div class="subservices-grid">
      
      <!-- Card 1 -->
      <div class="subservice-card" id="assessment">
        <h3>Adults Psychological Assessment</h3>
        <p>Understanding one's own mind is the first step toward Healing, Progress & Growth. Adults Psychological Assessment involves structured clinical interviews, standardized psychometric tools, and behavioural observation to evaluate cognitive functioning, emotional patterns, personality traits, and underlying mental health concerns. This process helps identify conditions such as Anxiety, Mood Disorders, Attention Difficulties, or Unresolved Trauma that may be quietly draining a person's energy and confidence. A thorough assessment forms the foundation for an accurate diagnosis and a customised treatment plan, whether through CBT, Psychodynamic Exploration, or Supportive Counselling. Many adults carry emotional exhaustion for years without realising its root cause, mistaking it for simple tiredness or stress. A professional evaluation brings language and structure to these experiences, empowering individuals to make informed decisions about therapy, lifestyle changes, or further psychiatric consultation. Whether you're seeking clarity in person or through an online psychologist, a proper assessment is the compass that guides meaningful, lasting psychological growth and self-understanding.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 2 -->
      <div class="subservice-card" id="stress">
        <h3>Work Stress & Anger Management</h3>
        <p>Modern work environments often demand constant performance, leaving professionals emotionally drained, irritable, and overwhelmed. Work Stress & Anger Management counselling addresses the buildup of chronic occupational stress, burnout, workplace conflict, and difficulty regulating frustration or rage. Using techniques like Cognitive Behavioural Therapy (CBT), Relaxation Training, Assertiveness Coaching, and Emotional Regulation Strategies, a counsellor helps individuals recognise triggers, reframe unhelpful thought patterns, and respond calmly rather than react impulsively. Left unmanaged, chronic stress and suppressed anger can affect physical health, relationships, and career growth, sometimes leading to anxiety or depressive symptoms. Sessions focus on building healthy communication skills, boundary-setting, and mindfulness-based coping mechanisms suited to demanding professional lives. Whether consulting a therapist near you or opting for tele-counselling for convenience, structured guidance helps restore emotional balance. With consistent support, individuals learn to transform workplace pressure into resilience, improving both productivity and overall psychological wellbeing over time.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 3 -->
      <div class="subservice-card" id="anxiety">
        <h3>Anxiety Disorder & OCD Management</h3>
        <p>Persistent worry, racing thoughts, intrusive fears, and repetitive compulsions can quietly take over daily life. Anxiety Disorder & OCD Management counselling combines Cognitive Behavioural Therapy, Exposure and Response Prevention (ERP), Mindfulness practices, and Relaxation Techniques to help individuals regain control over their thoughts and behaviours. Generalised anxiety, panic attacks, social anxiety, and obsessive-compulsive patterns are often emotionally exhausting, affecting concentration, relationships, and self-esteem. A skilled psychologist works to identify triggers, challenge distorted thinking, and gradually reduce avoidance or compulsive rituals through structured, evidence-based interventions. Therapy also addresses the physical symptoms of anxiety, restlessness, fatigue, and sleep disturbance through breathing techniques and grounding exercises. Consistent sessions, whether online or in person, provide a safe space to process fears without judgment. With the right therapeutic support, individuals learn practical tools to manage anxious thoughts, reduce compulsive behaviours, and rebuild confidence, leading to calmer, more balanced everyday functioning.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>

      <!-- Card 4 -->
      <div class="subservice-card" id="depression">
        <h3>Depression Relief Counselling</h3>
        <p>Persistent sadness, low energy, loss of interest, and emotional numbness are signs that professional support may be needed. Depression Relief Counselling uses therapeutic approaches such as Cognitive Behavioural Therapy, Behavioural Activation, Interpersonal Therapy, and mindfulness-based interventions to help individuals understand the psychological roots of their low mood and rebuild motivation. Depression often stems from a mix of biological, situational, and relational factors, and can leave a person feeling emotionally drained, isolated, or hopeless. Our counsellor provides a compassionate, non-judgmental space to explore these feelings, challenge negative self-beliefs, and gradually reintroduce meaningful activities into daily routine. Sessions may also address sleep patterns, self-care habits, and social withdrawal that accompany depressive episodes. Whether seeking a licensed psychologist for regular sessions or an online counsellor for flexibility, consistent therapeutic engagement supports emotional recovery. With patience and the right guidance, individuals can move from emotional exhaustion toward renewed hope, purpose, and psychological stability.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 5 -->
      <div class="subservice-card" id="personality">
        <h3>Personality Disorder Counselling</h3>
        <p>Long-standing patterns of thinking, relating, and behaving that disrupt relationships and self-image may point to an underlying personality disorder. Personality Disorder Counselling uses Dialectical Behaviour Therapy (DBT), Schema Therapy, Psychodynamic Approaches, and skills-based training to help individuals understand deep-rooted emotional patterns and build healthier ways of relating to themselves and others. Conditions such as Borderline Personality Disorder (BPD), Narcissistic Personality Disorder (NPD), Histrionic Personality Disorder (HPD), Avoidant, or Dependent Personality Traits often bring intense emotional swings, unstable relationships, and identity confusion, which can be exhausting for both the individual and their loved ones. Therapy focuses on emotional regulation, distress tolerance, interpersonal effectiveness, and self-awareness, gradually reshaping ingrained behavioural patterns. Our Counsellors handle you with patience, consistency, and a strong therapeutic alliance. With sustained support, individuals can develop greater emotional stability, healthier relationships, and a more secure, grounded sense of self over time.</p>
        <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline" style="margin-top: 24px; display: inline-block;">Book an Appointment</a>
      </div>
      
      <!-- Card 6 -->
      <div class="subservice-card" id="co-parenting">
        <h3>Single / Co-Parenting Guidance</h3>
        <p>Raising a child alone or navigating shared parenting after separation brings unique emotional and practical challenges. Single / Co-Parenting Guidance counselling supports parents in managing stress, guilt, communication breakdowns, and the emotional wellbeing of both themselves and their children. Using family systems therapy, solution-focused approaches, and communication coaching, a counsellor helps parents establish consistent routines, healthy co-parenting boundaries, and constructive conflict resolution strategies. The emotional toll of single parenting or contentious co-parenting arrangements can leave individuals feeling drained, isolated, or anxious about their child's development.</p>
        <p style="margin-top: 10px;">Our Psychologists also address children's emotional needs, helping parents respond with empathy while maintaining structure and stability at home. Whether seeking a female counsellor, male counsellor, or family therapist, our personalised guidance helps parents rebuild confidence in their parenting role. With the right support, single and co-parents can create a nurturing, low-conflict environment that promotes emotional security and healthy development for their children.</p>
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
    <p style="max-width: 600px; margin: 0 auto 30px; color: var(--slate-gray);">Whether you want to overcome stress or navigate personal struggles, our experts are here to guide you.</p>
    <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-primary">Book an Appointment</a>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
