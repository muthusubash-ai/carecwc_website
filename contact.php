<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/seo-meta.php';

$pageTitle = "Book a Counselling Session in Chennai | Contact CARE Family Counselling";
$pageDescription = "Book a confidential counselling appointment with CARE Chennai. Call +91 99658 55184, WhatsApp us, or fill our booking form. Located in Pallikaranai, Chennai. Open all 7 days, 10:30 AM - 8:30 PM.";
$pageKeywords = "contact counsellor Chennai, book counselling session, CARE Pallikaranai, book appointment Chennai psychologist, WhatsApp counselling";
$pageCanonical = SITE_URL . "/contact";
$activeNav = "contact";

$contactSuccess = false;
$bookingSuccess = false;
$errors = [];

// ---------- Services list for all dropdowns ----------
$serviceList = [
    'Couple / Marital Relationship Counselling',
    'Pre-Marital Assessment & Guidance',
    'Parental Guidance - Children Counselling',
    'Teenage / Adolescent Counselling',
    'Extra Marital Affair Counselling',
    'Post-Partum Depression Counselling',
    'Divorce Counselling / Guidance',
    'Single / Co-Parenting Guidance',
    'Work Stress & Anger Management',
    'Anxiety, Depression, OCD Counselling',
    'ASD, ADHD Assessment & Counselling',
    'Career Options & Career Guidance',
    'Drug De-Addiction - Rehab Guidance',
    'Mobile / Online Gaming / Gadget De-Addiction',
    'Porn / Sex De-Addiction Counselling',
];

function renderServiceOptions($list) {
    echo '<option value="">— Select a service —</option>';
    foreach ($list as $service) {
        echo '<option value="' . htmlspecialchars($service) . '">' . htmlspecialchars($service) . '</option>';
    }
    echo '<option value="Other">Other / Not sure</option>';
}

// ---------- Handle Contact Form ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'contact') {
    csrfCheck();

    // Honeypot — bots fill hidden fields
    if (!empty($_POST['website'])) { $contactSuccess = true; goto render_page; }

    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $phone === '' || $message === '') {
        $errors[] = "Please fill in your name, email, phone number, and message.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    } else {
        $fullMessage = $service !== '' ? ("[Service: " . $service . "]\n" . $message) : $message;
        $stmt = mysqli_prepare($conn, "INSERT INTO contact_messages (name, email, phone, message) VALUES (?,?,?,?)");
        mysqli_stmt_bind_param($stmt, 'ssss', $name, $email, $phone, $fullMessage);
        if (mysqli_stmt_execute($stmt)) {
            $contactSuccess = true;
            // Send email notification to admin
            $to = SITE_EMAIL;
            $subject = "💬 New Contact Message — " . $name;
            $body  = "You have received a new contact message on carecwc.com\n\n";
            $body .= "----------------------------------------\n";
            $body .= "Name    : " . $name . "\n";
            $body .= "Email   : " . $email . "\n";
            $body .= "Phone   : " . $phone . "\n";
            if ($service) $body .= "Service : " . $service . "\n";
            $body .= "Message :\n" . $message . "\n";
            $body .= "----------------------------------------\n";
            $body .= "Submitted: " . date('d M Y, h:i A') . "\n\n";
            $body .= "Reply to client: mailto:" . $email . "\n";
            $body .= "View in admin: " . SITE_URL . "/admin/manage-messages\n";
            $headers  = "From: CARE Website <no-reply@carecwc.com>\r\n";
            $headers .= "Reply-To: " . $email . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            @mail($to, $subject, $body, $headers);
        } else {
            $errors[] = "Something went wrong. Please try again or WhatsApp us directly.";
        }
    }
}

// ---------- Handle Booking Form ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'booking') {
    csrfCheck();

    // Honeypot
    if (!empty($_POST['website'])) { $bookingSuccess = true; goto render_page; }

    $bname = trim($_POST['b_name'] ?? '');
    $bemail = trim($_POST['b_email'] ?? '');
    $bphone = trim($_POST['b_phone'] ?? '');
    $bservice = trim($_POST['b_service'] ?? '');
    $bday = trim($_POST['preferred_day'] ?? '');
    $btime = trim($_POST['preferred_time'] ?? '');
    $bmessage = trim($_POST['b_message'] ?? '');

    if ($bname === '' || $bemail === '' || $bphone === '' || $bday === '' || $btime === '') {
        $errors[] = "Please fill in all required booking fields.";
    } elseif (!filter_var($bemail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address for booking.";
    } else {
        $bslot = $bday . ' | ' . $btime;
        $stmt = mysqli_prepare($conn, "INSERT INTO bookings (name, email, phone, service, preferred_date, preferred_time, message) VALUES (?,?,?,?,CURDATE(),?,?)");
        mysqli_stmt_bind_param($stmt, 'ssssss', $bname, $bemail, $bphone, $bservice, $bslot, $bmessage);
        if (mysqli_stmt_execute($stmt)) {
            $bookingSuccess = true;
            // Send email notification to admin
            $to = SITE_EMAIL;
            $subject = "🔔 New Appointment Booking — " . $bname;
            $body  = "You have received a new appointment booking on carecwc.com\n\n";
            $body .= "----------------------------------------\n";
            $body .= "Name           : " . $bname . "\n";
            $body .= "Email          : " . $bemail . "\n";
            $body .= "Phone          : " . $bphone . "\n";
            if ($bservice) $body .= "Service        : " . $bservice . "\n";
            $body .= "Preferred Day  : " . $bday . "\n";
            $body .= "Preferred Time : " . $btime . "\n";
            if ($bmessage) $body .= "Message        :\n" . $bmessage . "\n";
            $body .= "----------------------------------------\n";
            $body .= "Submitted: " . date('d M Y, h:i A') . "\n\n";
            $body .= "Reply to client: mailto:" . $bemail . "\n";
            $body .= "View in admin: " . SITE_URL . "/admin/manage-bookings\n";
            $headers  = "From: CARE Website <no-reply@carecwc.com>\r\n";
            $headers .= "Reply-To: " . $bemail . "\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            @mail($to, $subject, $body, $headers);
        } else {
            $errors[] = "Something went wrong with your booking. Please try again or WhatsApp us directly.";
        }
    }
}

render_page:
include __DIR__ . '/includes/header.php';
?>

<section class="hero" style="padding:40px 0 24px;">
  <div class="container">
    <span class="eyebrow">Get In Touch</span>
    <h1>Contact Us</h1>
    <p class="lead">Reach us by form, WhatsApp, or book your session directly on our calendar below.</p>
  </div>
</section>

<section>
  <div class="container">
    <div class="grid grid-2" style="align-items:start;">

      <!-- LEFT: Map + contact details -->
      <div>
        <h2>Find Us</h2>
        <iframe
          src="https://www.google.com/maps?q=<?= SITE_MAPS_EMBED_LAT ?>,<?= SITE_MAPS_EMBED_LNG ?>&hl=en&z=16&output=embed"
          width="100%" height="360" style="border:0; border-radius:14px;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade" title="CARE Family Counselling location map">
        </iframe>
        <p style="margin-top:14px;"><a href="<?= h(SITE_MAPS_URL) ?>" target="_blank" rel="noopener">View on Google Maps &amp; Read Reviews →</a></p>

        <div style="margin-top:24px;">
          <h3>Other Ways to Reach Us</h3>
          <p>📍 <?= SITE_ADDRESS_HTML ?><br>
          📞 <a href="tel:<?= SITE_PHONE_LINK ?>"><?= h(SITE_PHONE) ?></a><br>
          ✉️ <a href="mailto:<?= SITE_EMAIL ?>"><?= h(SITE_EMAIL) ?></a></p>
          <a href="https://wa.me/<?= SITE_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">Chat on WhatsApp</a>
        </div>
      </div>

      <!-- RIGHT: Send a message form -->
      <div>
        <h2>Send Us a Message</h2>
        <div class="form-card">
          <?php if ($contactSuccess): ?>
            <div class="alert alert-success" style="margin-bottom:0;">
              <h3 style="margin:0 0 10px;color:#1c7a3d;">✓ Message Sent Successfully!</h3>
              <p style="margin:0 0 12px;">Thank you for reaching out. We'll get back to you shortly.</p>
              <a href="<?= SITE_URL ?>/contact" class="btn btn-outline" style="margin-top:8px;">Send Another Message</a>
            </div>
          <?php else: ?>
          <?php if ($errors && isset($_POST['form_type']) && $_POST['form_type'] === 'contact'): foreach ($errors as $e): ?>
            <div class="alert alert-error"><?= h($e) ?></div>
          <?php endforeach; endif; ?>

          <form method="POST" action="<?= SITE_URL ?>/contact">
            <?= csrfField() ?>
            <input type="hidden" name="form_type" value="contact">
            <div style="position:absolute;left:-9999px;" aria-hidden="true">
              <label for="c_website">Leave blank</label>
              <input type="text" id="c_website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <label for="name">Full Name *</label>
            <input type="text" id="name" name="name" required value="<?= h($_POST['name'] ?? '') ?>">

            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required value="<?= h($_POST['email'] ?? '') ?>">

            <label for="phone">Phone Number *</label>
            <input type="tel" id="phone" name="phone" required inputmode="numeric" pattern="[0-9]{10,15}" maxlength="15" title="Please enter numbers only (10-15 digits)" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['phone'] ?? '') ?>">

            <label for="service">Service You're Interested In</label>
            <select id="service" name="service">
              <?php renderServiceOptions($serviceList); ?>
            </select>

            <label for="message">Message *</label>
            <textarea id="message" name="message" required placeholder="Tell us briefly what you'd like support with..."><?= h($_POST['message'] ?? '') ?></textarea>

            <button type="submit" class="btn btn-primary btn-block">Send Message</button>
          </form>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="booking" class="section-alt">
  <div class="container" style="max-width:720px;">
    <div class="section-header center">
      <span class="eyebrow">Book Online</span>
      <h2>Online Booking Calendar</h2>
      <p>Pick a date and time that works for you — we'll confirm your session shortly after.</p>
    </div>

    <div class="form-card">
      <?php if ($bookingSuccess): ?>
        <div style="text-align:center;padding:30px 20px;">
          <div style="font-size:48px;margin-bottom:16px;">✅</div>
          <h3 style="color:#1c7a3d;margin:0 0 12px;">Booking Request Received!</h3>
          <p>Thank you for reaching out to CARE Family Counselling &amp; Children's Wellness Center.</p>
          <p>We will contact you shortly to confirm your appointment.</p>
          <div style="margin-top:20px;display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="https://wa.me/<?= SITE_WHATSAPP ?>" target="_blank" rel="noopener" class="btn btn-whatsapp">Chat on WhatsApp</a>
            <a href="<?= SITE_URL ?>/contact#booking" class="btn btn-outline">Book Another Session</a>
          </div>
        </div>
      <?php else: ?>
      <?php if ($errors && isset($_POST['form_type']) && $_POST['form_type'] === 'booking'): foreach ($errors as $e): ?>
        <div class="alert alert-error"><?= h($e) ?></div>
      <?php endforeach; endif; ?>

      <form method="POST" action="<?= SITE_URL ?>/contact#booking">
        <?= csrfField() ?>
        <input type="hidden" name="form_type" value="booking">
        <div style="position:absolute;left:-9999px;" aria-hidden="true">
          <label for="b_website">Leave blank</label>
          <input type="text" id="b_website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <label for="b_name">Full Name *</label>
        <input type="text" id="b_name" name="b_name" required value="<?= h($_POST['b_name'] ?? '') ?>">

        <label for="b_email">Email *</label>
        <input type="email" id="b_email" name="b_email" required value="<?= h($_POST['b_email'] ?? '') ?>">

        <label for="b_phone">Phone Number *</label>
        <input type="tel" id="b_phone" name="b_phone" required inputmode="numeric" pattern="[0-9]{10,15}" maxlength="15" title="Please enter numbers only (10-15 digits)" oninput="this.value=this.value.replace(/[^0-9]/g,'')" value="<?= h($_POST['b_phone'] ?? '') ?>">

        <label for="b_service">Service Needed *</label>
        <select id="b_service" name="b_service" required>
          <?php renderServiceOptions($serviceList); ?>
        </select>

        <div class="form-row">
          <div>
            <label for="preferred_day">Preferred Day *</label>
            <select id="preferred_day" name="preferred_day" required>
              <option value="">— Select a day —</option>
              <option value="Weekdays (Mon-Thu)">Weekdays (Mon-Thu)</option>
              <option value="Weekend (Fri-Sat-Sun)">Weekend (Fri-Sat-Sun)</option>
            </select>
          </div>
          <div>
            <label for="preferred_time">Preferred Time *</label>
            <select id="preferred_time" name="preferred_time" required>
              <option value="">— Select a time —</option>
              <option value="Morning Slot - 10.30 AM">Morning Slot - 10.30 AM</option>
              <option value="Afternoon Slot - 2.30 PM">Afternoon Slot - 2.30 PM</option>
              <option value="Evening Slot - 6.30 PM">Evening Slot - 6.30 PM</option>
            </select>
          </div>
        </div>

        <label for="b_message">Anything you'd like us to know?</label>
        <textarea id="b_message" name="b_message"></textarea>

        <button type="submit" class="btn btn-gold btn-block">Request Booking</button>
      </form>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
