# CARE Family Counselling & Children's Wellness Center
## Website Package — Deployment Guide (Hostinger)

This package contains a **fully tested, working PHP + MySQL website** with:
- Dynamic homepage, services, psychologists, events, and contact pages
- **Admin panel** to add/edit/delete events (auto-splits into Upcoming vs Past based on date)
- **Online booking calendar** + **contact form** + **WhatsApp button** (all save to your database)
- Full SEO: clean URLs, meta tags, sitemap.xml, robots.txt, schema markup (JSON-LD)
- AEO/GEO: FAQ sections, `llms.txt`, structured Q&A content
- Mobile-responsive design using your brand colors
- CSRF protection, honeypot spam traps, brute-force lockout, secure session cookies

---

## STEP 1 — Create the Database on Hostinger

1. Log in to **Hostinger hPanel**
2. Go to **Databases → MySQL Databases**
3. Create a new database (e.g. `u123456789_carecwc`) and a database user with a strong password
4. Note down: **Database name**, **Database username**, **Database password**, **Database host** (usually `localhost`)

## STEP 2 — Import the Database Schema

1. In hPanel, open **phpMyAdmin** for your new database
2. Click **Import**
3. Upload the file `database.sql` (included in this package)
4. Click **Go** — this creates all 4 tables: `admin_users`, `events`, `bookings`, `contact_messages`

## STEP 3 — Update Your Site Configuration

1. Open `includes/config.php` in a text editor
2. Replace these 3 lines with your actual Hostinger database credentials:
   ```php
   define('DB_NAME', 'YOUR_DB_NAME_HERE');
   define('DB_USER', 'YOUR_DB_USER_HERE');
   define('DB_PASS', 'YOUR_DB_PASSWORD_HERE');
   ```
3. Save the file

## STEP 4 — Upload Files to Hostinger

1. In hPanel, go to **File Manager** (or use FTP with FileZilla)
2. Navigate to `public_html` (this is your domain's root folder)
3. Upload **all files and folders** from this package directly into `public_html`
   (so `index.php` sits directly inside `public_html`, not in a subfolder)
4. Make sure the `uploads/events/` folder has write permissions (755 or 775) so the admin panel can save event images

## STEP 5 — Create Your Admin Login

1. Open `admin/create-admin.php` in a text editor and set a **strong password** (replace `CHANGE_ME_NOW_2026!`)
2. Upload the file to your server
3. Visit `https://carecwc.com/admin/create-admin.php` **once** in your browser
4. **Immediately delete `create-admin.php` from your server** (via File Manager)
5. Log in at `https://carecwc.com/admin/login.php`
6. Go to **Change Password** in the admin panel to set your final password

## STEP 6 — Add Your Real Content

- **Logo:** Replace `assets/images/care-family-counselling-logo.webp` with your own (update dimensions in `includes/header.php` if needed)
- **Favicon:** Replace `assets/images/favicon.svg` and `assets/images/apple-touch-icon.png`
- **Psychologist Photos:** Replace `assets/images/siva-priya.webp` and `assets/images/damodaran.webp`
- **Events:** Log into `/admin/` and use **Manage Events → Add New Event**

## STEP 7 — Final Checks

- Visit `https://carecwc.com/sitemap.xml` — should list all your pages and events
- Visit `https://carecwc.com/robots.txt` — should show the crawl rules
- Submit your sitemap to **Google Search Console** (Search Console → Sitemaps → enter `sitemap.xml`)
- Test the contact form and booking calendar
- Test on your phone to confirm mobile layout
- Ensure SSL is enabled in Hostinger hPanel (usually automatic)

---

## What's Included

```
├── index.php, services.php, psychologists.php,     → Public pages
│   events.php, event-details.php, contact.php,
│   couple-counselling.php, etc.
├── admin/                                            → Admin panel (password protected)
│   ├── login.php, dashboard.php, logout.php
│   ├── add-event.php, edit-event.php, manage-events.php
│   ├── manage-bookings.php, manage-messages.php
│   ├── change-password.php
│   └── create-admin.php  ⚠️ DELETE after first use
├── includes/                                         → Core PHP (config, DB, SEO helpers)
├── assets/                                           → CSS, JS, images
├── uploads/events/                                   → Event images (uploaded via admin)
├── database.sql                                      → Import this into phpMyAdmin
├── .htaccess                                         → Clean URLs, HTTPS, caching, security
├── robots.txt, llms.txt, sitemap.php                 → SEO/AEO/GEO files
├── 404.php                                           → Custom error page
└── book-appointment.php                              → AJAX booking endpoint
```

## Security Features

- Admin passwords hashed with `password_hash()` (bcrypt)
- All database queries use **prepared statements** (SQL injection prevention)
- **CSRF tokens** on all forms (admin + public)
- **Honeypot fields** on public forms (bot spam prevention)
- **Rate limiting** on popup booking form (max 3 per 5 min)
- **Brute-force lockout** on admin login (5 attempts → 15 min block)
- Secure session cookies (HttpOnly, Secure, SameSite=Lax)
- Security headers (X-Content-Type-Options, X-Frame-Options, etc.)
- Sensitive files (.sql, .log) blocked via .htaccess
- `/admin/`, `/includes/` blocked from search indexing

---

Need to extend features? The codebase is structured for easy additions.
