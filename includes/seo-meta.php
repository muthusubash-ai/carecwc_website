<?php
/**
 * Call this BEFORE including header.php on every page:
 *
 * $pageTitle = "Home | " . SITE_NAME;
 * $pageDescription = "Trusted online marriage, family & child counselling in Chennai...";
 * $pageCanonical = SITE_URL . "/";
 * $pageSchema = [...]; // optional array of JSON-LD schema blocks
 * include 'includes/header.php';
 */

function renderSeoHead($title, $description, $canonical, $schemaBlocks = [], $ogImage = null) {
    global $pageOgImage, $pageKeywords;
    $ogImage = $ogImage ?: ($pageOgImage ?? (SITE_URL . '/assets/images/logo-social-share.jpg'));
    $keywords = $pageKeywords ?? 'counselling in Chennai, marriage counselling Chennai, family therapy, child counselling, psychologist Chennai, relationship therapy, depression, anxiety, career counselling, de-addiction, extra marital affair, Pallikaranai, CARE Counselling';
    ?>
    <title><?= h($title) ?></title>
    <meta name="description" content="<?= h($description) ?>">
    <meta name="keywords" content="<?= h($keywords) ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="author" content="<?= h(SITE_NAME) ?>">
    <link rel="canonical" href="<?= h($canonical) ?>">

    <!-- Geo (Chennai local SEO) -->
    <meta name="geo.region" content="IN-TN">
    <meta name="geo.placename" content="Chennai, Tamil Nadu">
    <meta name="geo.position" content="12.9366;80.2007">
    <meta name="ICBM" content="12.9366, 80.2007">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= h($title) ?>">
    <meta property="og:description" content="<?= h($description) ?>">
    <meta property="og:url" content="<?= h($canonical) ?>">
    <meta property="og:image" content="<?= h($ogImage) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="<?= h(SITE_NAME) ?>">
    <meta property="og:locale" content="en_IN">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= h($title) ?>">
    <meta name="twitter:description" content="<?= h($description) ?>">
    <meta name="twitter:image" content="<?= h($ogImage) ?>">

    <?php foreach ($schemaBlocks as $schema): ?>
    <script type="application/ld+json">
    <?= json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
    </script>
    <?php endforeach; ?>
    <?php
}

/** Reusable LocalBusiness schema (include once on the homepage) */
function localBusinessSchema() {
    return [
        "@context" => "https://schema.org",
        "@type" => ["MedicalBusiness", "LocalBusiness", "ProfessionalService"],
        "name" => SITE_NAME,
        "alternateName" => "CARE Counselling Chennai",
        "description" => "Trusted counselling and mental wellness center in Chennai offering online and offline therapy for marriage, family, child, career, and de-addiction issues.",
        "image" => SITE_URL . "/assets/images/logo-social-share.jpg",
        "logo" => SITE_URL . "/assets/images/care-family-counselling-logo.webp",
        "url" => SITE_URL,
        "telephone" => SITE_PHONE,
        "email" => SITE_EMAIL,
        "priceRange" => "$$",
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "Plot # 156, Door # 5A, 6th Street, Kamakoti Nagar",
            "addressLocality" => "Pallikaranai",
            "addressRegion" => "Chennai, Tamil Nadu",
            "postalCode" => "600100",
            "addressCountry" => "IN"
        ],
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => SITE_MAPS_EMBED_LAT,
            "longitude" => SITE_MAPS_EMBED_LNG
        ],
        "openingHoursSpecification" => [
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"],
                "opens" => "10:30",
                "closes" => "20:30"
            ]
        ],
        "areaServed" => [
            ["@type" => "City", "name" => "Chennai"],
            ["@type" => "State", "name" => "Tamil Nadu"],
            ["@type" => "Country", "name" => "India"]
        ],
        "sameAs" => [
            SITE_INSTAGRAM,
            defined('SITE_FACEBOOK') ? SITE_FACEBOOK : '',
            defined('SITE_YOUTUBE') ? SITE_YOUTUBE : ''
        ],
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => "Counselling Services",
            "itemListElement" => [
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "Marriage & Couple Counselling"]],
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "Child & Adolescent Counselling"]],
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "Individual Therapy (Anxiety, Depression, OCD)"]],
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "Career Counselling & Life Coaching"]],
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "De-Addiction & Rehabilitation Counselling"]],
                ["@type" => "Offer", "itemOffered" => ["@type" => "Service", "name" => "Extra Marital Affair Counselling"]]
            ]
        ],
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "4.9",
            "reviewCount" => "10",
            "bestRating" => "5"
        ]
    ];
}

/** FAQ schema builder — pass array of ['q'=>..., 'a'=>...] */
function faqSchema($faqs) {
    $items = array_map(function($f) {
        return [
            "@type" => "Question",
            "name" => $f['q'],
            "acceptedAnswer" => [
                "@type" => "Answer",
                "text" => $f['a']
            ]
        ];
    }, $faqs);

    return [
        "@context" => "https://schema.org",
        "@type" => "FAQPage",
        "mainEntity" => $items
    ];
}

/** Event schema builder */
function eventSchema($event) {
    return [
        "@context" => "https://schema.org",
        "@type" => "Event",
        "name" => $event['title'],
        "startDate" => $event['event_date'] . 'T' . (preg_replace('/[^0-9:]/', '', $event['event_time']) ?: '10:00'),
        "eventAttendanceMode" => "https://schema.org/OnlineEventAttendanceMode",
        "location" => [
            "@type" => "VirtualLocation",
            "url" => SITE_URL . "/event-details.php?slug=" . $event['slug']
        ],
        "description" => $event['short_description'],
        "organizer" => [
            "@type" => "Organization",
            "name" => SITE_NAME,
            "url" => SITE_URL
        ]
    ];
}
