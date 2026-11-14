<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request.']);
    exit;
}

// ---------- CSRF CHECK ----------
$sentToken = $_POST['csrf_token'] ?? '';
if (!$sentToken || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $sentToken)) {
    echo json_encode(['success' => false, 'error' => 'Security check failed. Please refresh the page and try again.']);
    exit;
}

// ---------- HONEYPOT CHECK (bot trap) ----------
if (!empty($_POST['website'])) {
    // Bots fill hidden fields; real users won't
    echo json_encode(['success' => true]); // fake success so bot thinks it worked
    exit;
}

// ---------- RATE LIMITING (max 3 submissions per 5 minutes per session) ----------
$now = time();
if (!isset($_SESSION['book_attempts'])) {
    $_SESSION['book_attempts'] = [];
}
// Clean old entries (older than 5 minutes)
$_SESSION['book_attempts'] = array_filter($_SESSION['book_attempts'], function($t) use ($now) {
    return ($now - $t) < 300;
});
if (count($_SESSION['book_attempts']) >= 3) {
    echo json_encode(['success' => false, 'error' => 'Too many submissions. Please wait a few minutes and try again.']);
    exit;
}
$_SESSION['book_attempts'][] = $now;

$name    = trim($_POST['name'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$service = trim($_POST['service'] ?? '');
$day     = trim($_POST['preferred_day'] ?? '');
$time    = trim($_POST['preferred_time'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $phone === '') {
    echo json_encode(['success' => false, 'error' => 'Please enter your name and phone number.']);
    exit;
}
if (!preg_match('/^[0-9+\-\s]{7,15}$/', $phone)) {
    echo json_encode(['success' => false, 'error' => 'Please enter a valid phone number.']);
    exit;
}

$slot = trim($day . ($day && $time ? ' | ' : '') . $time);
if ($slot === '') { $slot = 'To be confirmed'; }

// Save to database (admin panel)
$email = '';
$stmt = mysqli_prepare(
    $conn,
    "INSERT INTO bookings (name, email, phone, service, preferred_date, preferred_time, message)
     VALUES (?, ?, ?, ?, CURDATE(), ?, ?)"
);
mysqli_stmt_bind_param($stmt, 'ssssss', $name, $email, $phone, $service, $slot, $message);
$dbOk = mysqli_stmt_execute($stmt);

// Send email notification to admin
$to = defined('ADMIN_NOTIFICATION_EMAIL') ? ADMIN_NOTIFICATION_EMAIL : (defined('ADMIN_EMAIL') ? ADMIN_EMAIL : SITE_EMAIL);
$subject = "🔔 New Appointment Booking — " . $name;
$body = "You have received a new appointment booking on carecwc.com\n\n";
$body .= "----------------------------------------\n";
$body .= "Name       : " . $name . "\n";
$body .= "Phone      : " . $phone . "\n";
if ($service) $body .= "Service    : " . $service . "\n";
if ($day)     $body .= "Preferred Day  : " . $day . "\n";
if ($time)    $body .= "Preferred Time : " . $time . "\n";
if ($message) $body .= "Message    : " . $message . "\n";
$body .= "----------------------------------------\n";
$body .= "Submitted : " . date('d M Y, h:i A') . "\n\n";
$body .= "Reply to client: tel:" . $phone . "\n";
$body .= "View in admin: " . SITE_URL . "/admin/manage-bookings\n";

$headers  = "From: CARE Website <no-reply@carecwc.com>\r\n";
$headers .= "Reply-To: " . (defined('SITE_EMAIL') ? SITE_EMAIL : 'contact@carecwc.com') . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

@mail($to, $subject, $body, $headers, "-f no-reply@carecwc.com"); // fire-and-forget; don't fail submission if mail fails

if ($dbOk) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Something went wrong. Please try again.']);
}
