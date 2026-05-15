<?php

return [
    'site_name' => env('SEO_SITE_NAME', 'amrizal.site'),
    'description' => env('SEO_DESCRIPTION', 'Personal website of Amrizal — System Analyst & Builder. Analyzing systems, designing architecture, and building with code.'),
    'keywords' => [
        'system analyst',
        'software engineer',
        'laravel developer',
        'web development',
        'system architecture',
        'AI-assisted coding',
        'portfolio',
    ],
    'default_image' => env('SEO_DEFAULT_IMAGE', '/images/og-default.jpg'),
    'twitter_handle' => env('SEO_TWITTER_HANDLE', ''),
    'facebook_app_id' => env('SEO_FB_APP_ID', ''),
    'locale' => env('SEO_OG_LOCALE', 'id_ID'),
    'author' => env('SEO_AUTHOR', 'Amrizal'),

    'sitemap' => [
        'home' => [
            'priority' => env('SEO_SITEMAP_HOME_PRIORITY', '1.0'),
            'changefreq' => env('SEO_SITEMAP_HOME_FREQ', 'weekly'),
        ],
        'list' => [
            'priority' => env('SEO_SITEMAP_LIST_PRIORITY', '0.9'),
            'changefreq' => env('SEO_SITEMAP_LIST_FREQ', 'weekly'),
        ],
        'static' => [
            'priority' => env('SEO_SITEMAP_STATIC_PRIORITY', '0.8'),
            'changefreq' => env('SEO_SITEMAP_STATIC_FREQ', 'monthly'),
        ],
        'detail' => [
            'priority' => env('SEO_SITEMAP_DETAIL_PRIORITY', '0.7'),
            'changefreq' => env('SEO_SITEMAP_DETAIL_FREQ', 'monthly'),
        ],
        'low' => [
            'priority' => env('SEO_SITEMAP_LOW_PRIORITY', '0.5'),
            'changefreq' => env('SEO_SITEMAP_LOW_FREQ', 'yearly'),
        ],
    ],

    'robots' => [
        'crawl_delay' => env('SEO_ROBOTS_CRAWL_DELAY', 10),
        'disallow' => array_filter(explode(',', env('SEO_ROBOTS_DISALLOW', '/admin/,/login/'))),
    ],

    'og' => [
        'image_width' => env('SEO_OG_IMAGE_WIDTH', 1200),
        'image_height' => env('SEO_OG_IMAGE_HEIGHT', 630),
        'locale' => env('SEO_OG_LOCALE', 'id_ID'),
    ],
    'twitter' => [
        'card_type' => env('SEO_TWITTER_CARD_TYPE', 'summary_large_image'),
    ],

    'default_robots' => env('SEO_DEFAULT_ROBOTS', 'index, follow'),

    'meta_desc_length' => env('SEO_META_DESC_LENGTH', 160),
    'og_storage_path' => env('SEO_OG_STORAGE_PATH', 'storage/'),

    'google_fonts_url' => env('SEO_GOOGLE_FONTS_URL', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Nunito:wght@400;500;600;700&display=swap'),
    'alpinejs_cdn_url' => env('ALPINEJS_CDN_URL', 'https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js'),

    'pages' => [
        'home' => [
            'title' => env('SEO_PAGE_HOME_TITLE', 'Home'),
            'description' => env('SEO_PAGE_HOME_DESCRIPTION', null),
            'keywords' => env('SEO_PAGE_HOME_KEYWORDS', null),
        ],
        'blog' => [
            'title' => env('SEO_PAGE_BLOG_TITLE', 'Blog'),
            'description' => env('SEO_PAGE_BLOG_DESCRIPTION', 'Articles about system analysis, application architecture, and software development.'),
            'keywords' => env('SEO_PAGE_BLOG_KEYWORDS', 'blog, system analysis, software development, architecture'),
        ],
        'portfolio' => [
            'title' => env('SEO_PAGE_PORTFOLIO_TITLE', 'Portfolio'),
            'description' => env('SEO_PAGE_PORTFOLIO_DESCRIPTION', 'A collection of projects done personally and professionally at companies.'),
            'keywords' => env('SEO_PAGE_PORTFOLIO_KEYWORDS', 'portfolio, projects, system analyst, laravel'),
        ],
        'about' => [
            'title' => env('SEO_PAGE_ABOUT_TITLE', 'About Me'),
            'description' => env('SEO_PAGE_ABOUT_DESCRIPTION', 'Profile, experience, and skills of Amrizal as a System Analyst & Builder.'),
            'keywords' => env('SEO_PAGE_ABOUT_KEYWORDS', 'about, profile, system analyst, experience'),
        ],
        'contact' => [
            'title' => env('SEO_PAGE_CONTACT_TITLE', 'Contact'),
            'description' => env('SEO_PAGE_CONTACT_DESCRIPTION', 'Contact Amrizal — System Analyst & Builder. Open for discussion, collaboration, or questions.'),
            'keywords' => env('SEO_PAGE_CONTACT_KEYWORDS', 'contact, collaboration, hire, system analyst'),
        ],
    ],
];
