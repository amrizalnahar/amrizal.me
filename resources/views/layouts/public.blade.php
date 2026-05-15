{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html x-data x-bind:lang="$store.i18n.locale" lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', 'Personal website of Amrizal — System Analyst & Builder')">
    <meta property="og:title" content="@yield('title', config('app.name'))">
    <meta property="og:description" content="@yield('description', 'Personal website of Amrizal — System Analyst & Builder')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', config('seo.default_image'))">
    <meta property="og:image:width" content="{{ config('seo.og.image_width', 1200) }}">
    <meta property="og:image:height" content="{{ config('seo.og.image_height', 630) }}">
    <meta name="twitter:card" content="{{ config('seo.twitter.card_type', 'summary_large_image') }}">
    <meta name="author" content="@yield('meta_author', config('seo.author'))">
    <meta name="keywords" content="@yield('meta_keywords', implode(', ', config('seo.keywords', [])))">
    <meta name="robots" content="@yield('meta_robots', config('seo.default_robots', 'index, follow'))">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('structured_data')

    <script>
        window.initialLocale = '{{ app()->getLocale() }}';
        window.translations = {
            id: @json(__('public', [], 'id')),
            en: @json(__('public', [], 'en'))
        };
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .text-balance { text-wrap: balance; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .card-animate {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-animate.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .card-animate[data-delay="1"] { transition-delay: 0.1s; }
        .card-animate[data-delay="2"] { transition-delay: 0.2s; }
        .card-animate[data-delay="3"] { transition-delay: 0.3s; }
        .card-animate[data-delay="4"] { transition-delay: 0.4s; }
        .card-animate[data-delay="5"] { transition-delay: 0.5s; }
        .noise-overlay {
            position: fixed; inset: 0; pointer-events: none; z-index: 9998;
            opacity: 0.035;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)'/%3E%3C/svg%3E");
            background-repeat: repeat; background-size: 128px 128px;
        }
        .scroll-progress {
            position: fixed; top: 0; left: 0; height: 2px;
            background: linear-gradient(90deg, #C3110C, #E6501B);
            z-index: 9999; width: 0%; transition: width 0.1s linear;
        }
        .page-transition {
            position: fixed; inset: 0; background: #fff; z-index: 10000;
            opacity: 0; pointer-events: none;
            transition: opacity 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .page-transition.active { opacity: 1; pointer-events: auto; }
        .dark .page-transition { background: #0a0a0a; }
        @keyframes forceHideOverlay {
            0%, 90% { opacity: 1; }
            100% { opacity: 0; pointer-events: none; }
        }
        .page-transition.active {
            animation: forceHideOverlay 1.5s forwards;
        }
        ::selection {
            background: rgba(230, 80, 27, 0.3);
            color: inherit;
        }
        ::-moz-selection {
            background: rgba(230, 80, 27, 0.3);
            color: inherit;
        }
        .custom-cursor {
            position: fixed; pointer-events: none; z-index: 10001;
            top: 0; left: 0; display: none;
        }
        @media (pointer: fine) and (prefers-reduced-motion: no-preference) {
            body, a, button, [role="button"], input, textarea, select, label, .back-to-top {
                cursor: none;
            }
            .custom-cursor { display: block; }
        }
        .cursor-dot {
            width: 6px; height: 6px; background: #C3110C; border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 0 1px rgba(255,255,255,0.4);
        }
        .cursor-ring {
            width: 32px; height: 32px;
            border: 1.5px solid rgba(195, 17, 12, 0.7); border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.25s cubic-bezier(0.4,0,0.2,1),
                        height 0.25s cubic-bezier(0.4,0,0.2,1),
                        border-color 0.25s;
        }
        .cursor-ring.hover { width: 48px; height: 48px; border-color: rgba(195, 17, 12, 0.95); }
        .hero-word {
            display: inline-block; opacity: 0; transform: translateY(24px);
            transition: opacity 0.5s cubic-bezier(0.4, 0, 0.2, 1),
                        transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .stagger-active .hero-word { opacity: 1; transform: translateY(0); }
        .back-to-top {
            position: fixed; bottom: 1.5rem; right: 1.5rem;
            width: 44px; height: 44px; border-radius: 50%;
            background: #fff; border: 1px solid #e5e5e5; color: #171717;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transform: translateY(10px);
            transition: opacity 0.3s, transform 0.3s; z-index: 9990;
        }
        .dark .back-to-top { background: #171717; border-color: #404040; color: #fff; }
        .back-to-top.visible { opacity: 1; transform: translateY(0); }
        .back-to-top-ring { position: absolute; inset: 0; width: 100%; height: 100%; }
        .back-to-top-progress { transition: stroke-dashoffset 0.1s linear; }
        body, nav, footer, section, article, aside, header, main, a, button {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 200ms;
        }
    </style>

    <script>
        (function() {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    @stack('styles')
</head>
<body class="font-sans bg-white text-neutral-900 dark:bg-neutral-950 dark:text-neutral-50 antialiased">

    <x-global-ui />
    <x-public-navbar :active="$activeNav ?? 'home'" />
    <x-public-mobile-drawer :active="$activeNav ?? 'home'" />

    <main>
        @yield('content')
    </main>

    <x-public-footer />
    <x-public-scripts />

    @stack('scripts')

    @livewireScripts
</body>
</html>
