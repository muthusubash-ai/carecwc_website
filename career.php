<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Careers at CARE | Psychology Job Openings & Internships in Chennai";
$pageDescription = "Explore job and internship opportunities at CARE Family Counselling & Children's Wellness Center, Chennai. Apply for psychologist positions or clinical internships.";
$pageKeywords = "psychology jobs Chennai, psychology internship Chennai, clinical psychologist vacancies, CARE Pallikaranai careers, counselling psychologist jobs";
$pageCanonical = SITE_URL . "/career";
$activeNav = "career";

$jobSuccess = false;
$jobErrors  = [];

$internshipSuccess = false;
$internshipErrors  = [];

// ============================================================================
// 1. HANDLE JOB APPLICATION FORM (LEFT SIDE)
// ============================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'job_apply') {
    csrfCheck();

    // Honeypot check
    if (!empty($_POST['website'])) {
        $jobSuccess = true;
        goto render_page;
    }

    $name             = trim($_POST['job_name'] ?? '');
    $gender           = trim($_POST['job_gender'] ?? '');
    $age              = trim($_POST['job_age'] ?? '');
    $phone            = trim($_POST['job_phone'] ?? '');
    $email            = trim($_POST['job_email'] ?? '');
    $degree           = trim($_POST['job_degree'] ?? '');
    $specialization   = trim($_POST['job_specialization'] ?? '');
    $internshipAt     = trim($_POST['job_internship_at'] ?? '');
    $experience       = trim($_POST['job_experience'] ?? '');
    $top5Special      = trim($_POST['job_top5'] ?? '');
    $profileName      = trim($_POST['job_profile'] ?? '');
    $message          = trim($_POST['job_message'] ?? '');

    // Validation
    if ($name === '' || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $jobErrors[] = "Name: Please enter a valid name (alphabets only).";
    }
    if ($gender === '' || !in_array($gender, ['Male', 'Female', 'Transgender'])) {
        $jobErrors[] = "Gender: Please select Male, Female, or Transgender.";
    }
    if ($age === '' || !preg_match('/^[0-9]+$/', $age)) {
        $jobErrors[] = "Age: Please enter a valid age (numbers only).";
    }
    if ($phone === '' || !preg_match('/^[0-9+\-\s]{10,15}$/', $phone)) {
        $jobErrors[] = "Phone Number: Please enter a valid 10-15 digit phone number.";
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $jobErrors[] = "Email Address: Please enter a valid email address.";
    }
    if ($degree === '') {
        $jobErrors[] = "Highest Degree: This field is mandatory.";
    }
    if ($specialization === '') {
        $jobErrors[] = "Specialization: This field is mandatory.";
    }
    if ($internshipAt === '') {
        $jobErrors[] = "Internship Done at: This field is mandatory.";
    }
    if ($experience === '' || !preg_match('/^[0-9]+$/', $experience)) {
        $jobErrors[] = "Relevant years of experience: Please enter numbers only.";
    }
    if ($top5Special === '') {
        $jobErrors[] = "Your top 5 specialization: This field is mandatory.";
    }
    if ($profileName === '') {
        $jobErrors[] = "Interested Profile Name: This field is mandatory.";
    }
    if ($message === '') {
        $jobErrors[] = "Your message: This field is mandatory.";
    }

    // Resume Upload Validation (PDF Only)
    $resumePath = '';
    if (!isset($_FILES['job_resume']) || $_FILES['job_resume']['error'] !== UPLOAD_ERR_OK) {
        $jobErrors[] = "Upload Resume: Please upload your resume (PDF only).";
    } else {
        $fileTmp  = $_FILES['job_resume']['tmp_name'];
        $fileName = $_FILES['job_resume']['name'];
        $fileSize = $_FILES['job_resume']['size'];
        $fileExt  = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt !== 'pdf') {
            $jobErrors[] = "Upload Resume: Only PDF files are allowed.";
        } elseif ($fileSize > 10 * 1024 * 1024) { // 10MB
            $jobErrors[] = "Upload Resume: File size must be less than 10MB.";
        } else {
            $uploadDir = __DIR__ . '/uploads/resumes/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $cleanBase = preg_replace('/[^a-zA-Z0-9_\-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
            $safeName  = 'job_' . date('Ymd_His') . '_' . $cleanBase . '.pdf';
            $destPath  = $uploadDir . $safeName;

            if (move_uploaded_file($fileTmp, $destPath)) {
                $resumePath = 'uploads/resumes/' . $safeName;
            } else {
                $jobErrors[] = "Failed to save the resume file. Please try again.";
            }
        }
    }

    // If no errors, save to DB
    if (empty($jobErrors)) {
        $fullMessage  = "[JOB APPLICATION]\n";
        $fullMessage .= "Name: " . $name . "\n";
        $fullMessage .= "Gender: " . $gender . "\n";
        $fullMessage .= "Age: " . $age . "\n";
        $fullMessage .= "Phone: " . $phone . "\n";
        $fullMessage .= "Email: " . $email . "\n";
        $fullMessage .= "Highest Degree: " . $degree . "\n";
        $fullMessage .= "Specialization: " . $specialization . "\n";
        $fullMessage .= "Internship Done at: " . $internshipAt . "\n";
        $fullMessage .= "Relevant Experience: " . $experience . " years\n";
        $fullMessage .= "Top 5 Specialization: " . $top5Special . "\n";
        $fullMessage .= "Interested Profile Name: " . $profileName . "\n";
        if ($resumePath) {
            $fullMessage .= "Resume File: " . SITE_URL . "/" . $resumePath . "\n";
        }
        $fullMessage .= "Your Message:\n" . $message . "\n";

        $stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (name, email, phone, message) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $phone, $fullMessage);

        if (mysqli_stmt_execute($stmt)) {
            $jobSuccess = true;

            // Email Notification to hiring team
            $to      = defined('CAREER_EMAIL') ? CAREER_EMAIL : 'hire.care.cwc@gmail.com';
            $subject = "💼 New Job Application — " . $name . " (" . $profileName . ")";
            $body    = "You have received a new job application on carecwc.com\n\n" . $fullMessage . "\n";
            $body   .= "Submitted on: " . date('d M Y, h:i A') . "\n";

            $headers  = "From: CARE Website <no-reply@carecwc.com>\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            @mail($to, $subject, $body, $headers);
        } else {
            $jobErrors[] = "Something went wrong saving your application. Please try again or WhatsApp us.";
        }
    }
}

// ============================================================================
// 2. HANDLE INTERNSHIP APPLICATION FORM (RIGHT SIDE)
// ============================================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'internship_apply') {
    csrfCheck();

    // Honeypot check
    if (!empty($_POST['website'])) {
        $internshipSuccess = true;
        goto render_page;
    }

    $name             = trim($_POST['intern_name'] ?? '');
    $gender           = trim($_POST['intern_gender'] ?? '');
    $phone            = trim($_POST['intern_phone'] ?? '');
    $email            = trim($_POST['intern_email'] ?? '');
    $degree           = trim($_POST['intern_degree'] ?? '');
    $specialization   = trim($_POST['intern_specialization'] ?? '');
    $college          = trim($_POST['intern_college'] ?? '');
    $duration         = trim($_POST['intern_duration'] ?? '');
    $casesCount       = trim($_POST['intern_cases'] ?? '');
    $studentsCount    = trim($_POST['intern_students'] ?? '');
    $message          = trim($_POST['intern_message'] ?? '');

    // Validation
    if ($name === '' || !preg_match('/^[a-zA-Z\s]+$/', $name)) {
        $internshipErrors[] = "Name: Please enter a valid name (alphabets only).";
    }
    if ($gender === '' || !in_array($gender, ['Male', 'Female', 'Transgender'])) {
        $internshipErrors[] = "Gender: Please select Male, Female, or Transgender.";
    }
    if ($phone === '' || !preg_match('/^[0-9+\-\s]{10,15}$/', $phone)) {
        $internshipErrors[] = "Phone Number: Please enter a valid 10-15 digit phone number.";
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $internshipErrors[] = "Email Address: Please enter a valid email address.";
    }
    if ($degree === '') {
        $internshipErrors[] = "Degree: This field is mandatory.";
    }
    if ($specialization === '') {
        $internshipErrors[] = "Specialization: This field is mandatory.";
    }
    if ($college === '') {
        $internshipErrors[] = "College / University Name: This field is mandatory.";
    }
    if ($duration === '' || !preg_match('/^[0-9]+$/', $duration)) {
        $internshipErrors[] = "Internship Duration (in Days) Required: Please enter numbers only.";
    }
    if ($casesCount === '' || !preg_match('/^[0-9]+$/', $casesCount)) {
        $internshipErrors[] = "No Of Cases Required To Submit: Please enter numbers only.";
    }
    if ($studentsCount === '' || !preg_match('/^[0-9]+$/', $studentsCount)) {
        $internshipErrors[] = "No Of Students Willing To Enroll: Please enter numbers only.";
    }
    if ($message === '') {
        $internshipErrors[] = "Your message: This field is mandatory.";
    }

    // If no errors, save to DB
    if (empty($internshipErrors)) {
        $fullMessage  = "[INTERNSHIP APPLICATION]\n";
        $fullMessage .= "Name: " . $name . "\n";
        $fullMessage .= "Gender: " . $gender . "\n";
        $fullMessage .= "Phone: " . $phone . "\n";
        $fullMessage .= "Email: " . $email . "\n";
        $fullMessage .= "Degree: " . $degree . "\n";
        $fullMessage .= "Specialization: " . $specialization . "\n";
        $fullMessage .= "College / University Name: " . $college . "\n";
        $fullMessage .= "Internship Duration (Days): " . $duration . "\n";
        $fullMessage .= "No Of Cases Required To Submit: " . $casesCount . "\n";
        $fullMessage .= "No Of Students Willing To Enroll: " . $studentsCount . "\n";
        $fullMessage .= "Your Message:\n" . $message . "\n";

        $stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (name, email, phone, message) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $phone, $fullMessage);

        if (mysqli_stmt_execute($stmt)) {
            $internshipSuccess = true;

            // Email Notification to hiring team
            $to      = defined('CAREER_EMAIL') ? CAREER_EMAIL : 'hire.care.cwc@gmail.com';
            $subject = "🎓 New Internship Request — " . $name . " (" . $college . ")";
            $body    = "You have received a new internship request on carecwc.com\n\n" . $fullMessage . "\n";
            $body   .= "Submitted on: " . date('d M Y, h:i A') . "\n";

            $headers  = "From: CARE Website <no-reply@carecwc.com>\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            @mail($to, $subject, $body, $headers);
        } else {
            $internshipErrors[] = "Something went wrong saving your request. Please try again or WhatsApp us.";
        }
    }
}

render_page:
$pageSchema = [[
    "@context" => "https://schema.org",
    "@type" => "JobPosting",
    "title" => "Clinical & Counselling Psychologist Openings & Internships",
    "description" => "CARE Family Counselling Center in Pallikaranai, Chennai offers job and internship opportunities for psychologists and counsellors.",
    "datePosted" => date('Y-m-d'),
    "hiringOrganization" => [
        "@type" => "Organization",
        "name" => SITE_NAME,
        "sameAs" => SITE_URL
    ],
    "jobLocation" => [
        "@type" => "Place",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Plot # 156, Door # 5A, 6th Street, Kamakoti Nagar, Pallikaranai",
            "addressLocality" => "Chennai",
            "postalCode" => "600100",
            "addressCountry" => "IN"
        ]
    ]
]];

include __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="events-hero">
  <div class="container">
    <span class="eyebrow">Join the CARE Family!</span>
    <h1>Explore Career Opportunities</h1>
    <p class="lead" style="max-width: 860px; line-height: 1.65;">
      At CARE Family Counselling &amp; Children’s Wellness Center, you’ll work in a warm, non-judgmental, confidentiality-first environment, alongside colleagues who value continuous learning and evidence-based practice. If you’re a passionate psychologist, counsellor, or wellness professional, we’d love to hear from you. Apply for Internships / jobs through the below forms.
    </p>
    <div class="events-hero-cta">
      <a href="#jobs-form" class="btn btn-primary">Apply for Jobs</a>
      <a href="#internship-form" class="btn btn-outline">Apply for Internship</a>
    </div>
  </div>
</section>

<!-- ============================================================================ -->
<!-- SPLIT FORMS SECTION: JOBS (LEFT) & INTERNSHIP (RIGHT)                         -->
<!-- ============================================================================ -->
<style>
.career-split-wrapper {
  padding: 50px 0 70px;
  background: #FAF9F6;
  border-top: 1px solid var(--border);
  border-bottom: 1px solid var(--border);
}
.career-split-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 36px;
  align-items: start;
}
.career-form-card {
  background: #ffffff;
  padding: 34px 28px;
  border-radius: var(--radius);
  border: 1px solid var(--border);
  box-shadow: var(--shadow);
}
.career-form-card h2 {
  font-size: 24px;
  color: var(--navy);
  margin: 0 0 22px;
  display: flex;
  align-items: center;
  gap: 8px;
}
.career-form-card .form-subtitle {
  color: #6E7688;
  font-size: 14px;
  margin: 0 0 20px;
}
.career-form-card .mandatory-note {
  font-size: 13px;
  color: #6E7688;
  margin-bottom: 18px;
  padding-bottom: 12px;
  border-bottom: 1px dashed var(--border);
}
.career-form-card label {
  display: block;
  font-weight: 600;
  margin-bottom: 6px;
  color: var(--navy);
  font-size: 14.5px;
}
.career-form-card label .req {
  color: #e53e3e;
  font-weight: bold;
}
.career-form-card input[type="text"],
.career-form-card input[type="email"],
.career-form-card input[type="tel"],
.career-form-card input[type="file"],
.career-form-card select,
.career-form-card textarea {
  width: 100%;
  padding: 11px 13px;
  border: 1px solid #dcd5c7;
  border-radius: 8px;
  font-family: inherit;
  font-size: 15px;
  color: var(--text);
  background: #fff;
  transition: border-color .15s ease, box-shadow .15s ease;
  margin-bottom: 16px;
}
.career-form-card input:focus,
.career-form-card select:focus,
.career-form-card textarea:focus {
  outline: none;
  border-color: var(--navy);
  box-shadow: 0 0 0 3px rgba(33, 62, 101, 0.12);
}
.career-alert-success {
  padding: 18px 20px;
  background: #e8f7ee;
  border: 1px solid #1c7a3d;
  border-radius: 10px;
  color: #1c7a3d;
  font-size: 15px;
  line-height: 1.55;
  margin-bottom: 22px;
  font-weight: 500;
}
.career-alert-error {
  padding: 14px 18px;
  background: #fee2e2;
  border: 1px solid #dc2626;
  color: #991b1b;
  border-radius: 8px;
  font-size: 14px;
  margin-bottom: 18px;
}
.career-alert-error ul {
  margin: 6px 0 0;
  padding-left: 20px;
}
@media (max-width: 960px) {
  .career-split-grid {
    grid-template-columns: 1fr;
    gap: 32px;
  }
}
</style>

<section class="career-split-wrapper" id="application-forms">
  <div class="container">
    
    <div style="text-align: center; max-width: 760px; margin: 0 auto 40px;">
      <span class="eyebrow">Apply Online</span>
      <h2 style="font-size: 32px; margin-bottom: 12px;">Career &amp; Internship Applications</h2>
      <p style="color: var(--slate-gray); font-size: 16px; margin: 0;">
        Choose the relevant form below. Permanent employment candidates please apply on the <strong>Left</strong>; students &amp; trainees apply on the <strong>Right</strong>.
      </p>
    </div>

    <div class="career-split-grid">

      <!-- ================================================================= -->
      <!-- LEFT SIDE: APPLY HERE FOR JOBS                                    -->
      <!-- ================================================================= -->
      <div class="career-form-card" id="jobs-form">
        <h2>💼 Apply Here For Jobs:</h2>

        <?php if ($jobSuccess): ?>
          <div class="career-alert-success">
            <strong>✓ Thank you. We have received your information, we will soon get back if there is a suitable open positions with us</strong>
          </div>
          <p><a href="<?= SITE_URL ?>/career#jobs-form" class="btn btn-outline" style="font-size: 14px; padding: 10px 20px;">Submit Another Application</a></p>
        <?php else: ?>

          <?php if (!empty($jobErrors)): ?>
            <div class="career-alert-error">
              <strong>Please correct the following:</strong>
              <ul>
                <?php foreach ($jobErrors as $err): ?>
                  <li><?= h($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" action="<?= SITE_URL ?>/career#jobs-form" enctype="multipart/form-data">
            <?= csrfField() ?>
            <input type="hidden" name="form_type" value="job_apply">
            
            <!-- Honeypot -->
            <div style="position:absolute;left:-9999px;" aria-hidden="true">
              <label for="j_website">Leave blank</label>
              <input type="text" id="j_website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <!-- 1. Name -->
            <label for="job_name">Name <span class="req">*</span></label>
            <input type="text" id="job_name" name="job_name" required pattern="[a-zA-Z\s]+" title="Allow only Alphabets" oninput="this.value=this.value.replace(/[^a-zA-Z\s]/g,'')" value="<?= h($_POST['job_name'] ?? '') ?>" placeholder="Enter your full name">

            <!-- Gender -->
            <label for="job_gender">Gender <span class="req">*</span></label>
            <select id="job_gender" name="job_gender" required>
              <option value="" disabled <?= empty($_POST['job_gender']) ? 'selected' : '' ?> hidden>Select Gender</option>
              <option value="Male" <?= (($_POST['job_gender'] ?? '') === 'Male') ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= (($_POST['job_gender'] ?? '') === 'Female') ? 'selected' : '' ?>>Female</option>
              <option value="Transgender" <?= (($_POST['job_gender'] ?? '') === 'Transgender') ? 'selected' : '' ?>>Transgender</option>
            </select>

            <!-- 3. Age -->
            <label for="job_age">Age <span class="req">*</span></label>
            <input type="text" id="job_age" name="job_age" required inputmode="numeric" pattern="[0-9]+" maxlength="3" title="Allow only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['job_age'] ?? '') ?>" placeholder="e.g. 28">

            <!-- Phone Number & Email -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
              <div>
                <label for="job_phone">Phone Number <span class="req">*</span></label>
                <input type="tel" id="job_phone" name="job_phone" required inputmode="numeric" pattern="[0-9]{10,15}" maxlength="15" title="Allow only numbers (10-15 digits)" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['job_phone'] ?? '') ?>" placeholder="e.g. 9876543210">
              </div>
              <div>
                <label for="job_email">Email Address <span class="req">*</span></label>
                <input type="email" id="job_email" name="job_email" required value="<?= h($_POST['job_email'] ?? '') ?>" placeholder="name@example.com">
              </div>
            </div>

            <!-- 4. Highest Degree -->
            <label for="job_degree">Highest Degree <span class="req">*</span></label>
            <input type="text" id="job_degree" name="job_degree" required value="<?= h($_POST['job_degree'] ?? '') ?>" placeholder="e.g. MSc Clinical Psychology / MPhil">

            <!-- 5. Specialization -->
            <label for="job_specialization">Specialization <span class="req">*</span></label>
            <input type="text" id="job_specialization" name="job_specialization" required value="<?= h($_POST['job_specialization'] ?? '') ?>" placeholder="e.g. Marriage &amp; Family / Child Therapy">

            <!-- 6. Internship Done at -->
            <label for="job_internship_at">Internship Done at <span class="req">*</span></label>
            <input type="text" id="job_internship_at" name="job_internship_at" required value="<?= h($_POST['job_internship_at'] ?? '') ?>" placeholder="Name of hospital, clinic, or institute">

            <!-- Relevant years of experience -->
            <label for="job_experience">Relevant years of experience <span class="req">*</span></label>
            <input type="text" id="job_experience" name="job_experience" required inputmode="numeric" pattern="[0-9]+" title="Allow only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['job_experience'] ?? '') ?>">

            <!-- 8. Your top 5 specialization -->
            <label for="job_top5">Your top 5 specialization: <span class="req">*</span></label>
            <input type="text" id="job_top5" name="job_top5" required value="<?= h($_POST['job_top5'] ?? '') ?>" placeholder="e.g. CBT, Couples, Anxiety, Depression, ASD">

            <!-- 9. Interested Profile Name -->
            <label for="job_profile">Interested Profile Name <span class="req">*</span></label>
            <input type="text" id="job_profile" name="job_profile" required value="<?= h($_POST['job_profile'] ?? '') ?>" placeholder="e.g. Consultant Clinical Psychologist">

            <!-- 10. Upload Resume (Only PDFs) -->
            <label for="job_resume">Upload Resume (Only PDFs) <span class="req">*</span></label>
            <input type="file" id="job_resume" name="job_resume" required accept=".pdf,application/pdf" style="padding: 8px 10px;">
            <small style="display:block; color:#6E7688; margin:-10px 0 16px; font-size:12.5px;">Note: PDF files only, max 10MB.</small>

            <!-- 11. Your message -->
            <label for="job_message">Your message <span class="req">*</span></label>
            <textarea id="job_message" name="job_message" required rows="3" placeholder="Tell us about yourself and your career goals..."><?= h($_POST['job_message'] ?? '') ?></textarea>

            <!-- 12. Submit Button -->
            <button type="submit" class="btn btn-primary btn-block" style="padding: 13px; font-size: 16px;"> Submit Job Application</button>
          </form>

        <?php endif; ?>
      </div>


      <!-- ================================================================= -->
      <!-- RIGHT SIDE: APPLY HERE FOR INTERNSHIP                             -->
      <!-- ================================================================= -->
      <div class="career-form-card" id="internship-form">
        <h2>🎓 Apply Here For Internship:</h2>

        <?php if ($internshipSuccess): ?>
          <div class="career-alert-success">
            <strong>✓ Thank you. We have received your internship request. We will soon get back to you. Or Reach us at 99-658-55-184</strong>
          </div>
          <p><a href="<?= SITE_URL ?>/career#internship-form" class="btn btn-outline" style="font-size: 14px; padding: 10px 20px;">Submit Another Request</a></p>
        <?php else: ?>

          <?php if (!empty($internshipErrors)): ?>
            <div class="career-alert-error">
              <strong>Please correct the following:</strong>
              <ul>
                <?php foreach ($internshipErrors as $err): ?>
                  <li><?= h($err) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form method="POST" action="<?= SITE_URL ?>/career#internship-form">
            <?= csrfField() ?>
            <input type="hidden" name="form_type" value="internship_apply">
            
            <!-- Honeypot -->
            <div style="position:absolute;left:-9999px;" aria-hidden="true">
              <label for="in_website">Leave blank</label>
              <input type="text" id="in_website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <!-- Name -->
            <label for="intern_name">Name <span class="req">*</span></label>
            <input type="text" id="intern_name" name="intern_name" required pattern="[a-zA-Z\s]+" title="Allow only Alphabets" oninput="this.value=this.value.replace(/[^a-zA-Z\s]/g,'')" value="<?= h($_POST['intern_name'] ?? '') ?>" placeholder="Enter your full name">

            <!-- Gender -->
            <label for="intern_gender">Gender <span class="req">*</span></label>
            <select id="intern_gender" name="intern_gender" required>
              <option value="" disabled <?= empty($_POST['intern_gender']) ? 'selected' : '' ?> hidden>Select Gender</option>
              <option value="Male" <?= (($_POST['intern_gender'] ?? '') === 'Male') ? 'selected' : '' ?>>Male</option>
              <option value="Female" <?= (($_POST['intern_gender'] ?? '') === 'Female') ? 'selected' : '' ?>>Female</option>
              <option value="Transgender" <?= (($_POST['intern_gender'] ?? '') === 'Transgender') ? 'selected' : '' ?>>Transgender</option>
            </select>

            <!-- Phone Number & Email -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
              <div>
                <label for="intern_phone">Phone Number <span class="req">*</span></label>
                <input type="tel" id="intern_phone" name="intern_phone" required inputmode="numeric" pattern="[0-9]{10,15}" maxlength="15" title="Allow only numbers (10-15 digits)" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['intern_phone'] ?? '') ?>" placeholder="e.g. 9876543210">
              </div>
              <div>
                <label for="intern_email">Email Address <span class="req">*</span></label>
                <input type="email" id="intern_email" name="intern_email" required value="<?= h($_POST['intern_email'] ?? '') ?>" placeholder="name@example.com">
              </div>
            </div>

            <!-- Degree -->
            <label for="intern_degree">Degree <span class="req">*</span></label>
            <input type="text" id="intern_degree" name="intern_degree" required value="<?= h($_POST['intern_degree'] ?? '') ?>" placeholder="e.g. BSc / MSc / MA Psychology">

            <!-- Specialization -->
            <label for="intern_specialization">Specialization <span class="req">*</span></label>
            <input type="text" id="intern_specialization" name="intern_specialization" required value="<?= h($_POST['intern_specialization'] ?? '') ?>" placeholder="e.g. Clinical / Counselling / Applied Psychology">

            <!-- College / University Name -->
            <label for="intern_college">College / University Name <span class="req">*</span></label>
            <input type="text" id="intern_college" name="intern_college" required value="<?= h($_POST['intern_college'] ?? '') ?>">

            <!-- Internship Duration (in Days) Required -->
            <label for="intern_duration">Internship Duration (in Days) Required <span class="req">*</span></label>
            <input type="text" id="intern_duration" name="intern_duration" required inputmode="numeric" pattern="[0-9]+" title="Allow only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['intern_duration'] ?? '') ?>">

            <!-- No Of Cases Required To Submit -->
            <label for="intern_cases">No Of Cases Required To Submit <span class="req">*</span></label>
            <input type="text" id="intern_cases" name="intern_cases" required inputmode="numeric" pattern="[0-9]+" title="Allow only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['intern_cases'] ?? '') ?>">

            <!-- No Of Students Willing To Enroll -->
            <label for="intern_students">No Of Students Willing To Enroll <span class="req">*</span></label>
            <input type="text" id="intern_students" name="intern_students" required inputmode="numeric" pattern="[0-9]+" title="Allow only numbers" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['intern_students'] ?? '') ?>">

            <!-- Your message -->
            <label for="intern_message">Your message <span class="req">*</span></label>
            <textarea id="intern_message" name="intern_message" required rows="3" placeholder="Tell us about your learning objectives or dates..."><?= h($_POST['intern_message'] ?? '') ?></textarea>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block" style="padding: 13px; font-size: 16px;"> Submit Internship Request</button>
          </form>

        <?php endif; ?>
      </div>

    </div>

  </div>
</section>

<!-- Career FAQ Section -->
<section style="padding: 46px 0 60px; background: #fff;">
  <div class="container" style="max-width: 900px;">
    <div style="text-align: center; margin-bottom: 36px;">
      <span class="eyebrow">FAQs</span>
      <h2>Frequently Asked Questions</h2>
    </div>

    <div class="accordion">
      <div style="border-bottom: 1px solid var(--border); padding: 18px 0;">
        <h3 style="margin: 0 0 8px; font-size: 18px; color: var(--navy);">What is the interview &amp; hiring process?</h3>
        <p style="color: var(--slate-gray); font-size: 15px; margin: 0; line-height: 1.6;">
          Our recruitment process consists of: (1) Initial CV screening, (2) Brief telephone discussion, (3) In-person clinical case discussion with our senior psychologists, and (4) Formal offer letter and onboarding.
        </p>
      </div>

      <div style="border-bottom: 1px solid var(--border); padding: 18px 0;">
        <h3 style="margin: 0 0 8px; font-size: 18px; color: var(--navy);">Do you provide recognized internship completion certificates?</h3>
        <p style="color: var(--slate-gray); font-size: 15px; margin: 0; line-height: 1.6;">
          Yes. All interns who complete their required clinical hours and case observation submissions receive an official institutional internship completion certificate from CARE Family Counselling &amp; Children's Wellness Center.
        </p>
      </div>

      <div style="border-bottom: 1px solid var(--border); padding: 18px 0;">
        <h3 style="margin: 0 0 8px; font-size: 18px; color: var(--navy);">Are sessions conducted offline, online, or hybrid?</h3>
        <p style="color: var(--slate-gray); font-size: 15px; margin: 0; line-height: 1.6;">
          We operate on a hybrid model. Initial assessments are preferably conducted in-person at our Pallikaranai center, with follow-ups held either in-clinic or through secure tele-counselling video consultations.
        </p>
      </div>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
