@extends('layouts.public')

@section('title', 'amrizal.me — ' . __('public.home.hero_subtitle'))
@section('description', 'Personal website of Amrizal — System Analyst & Builder. Analyzing systems, designing architecture, and building with code.')

@section('content')

<!-- Hero -->
<section class="pt-32 pb-16 md:pt-40 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="flex-1 text-center md:text-left">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="home.hero_subtitle">{{ __('public.home.hero_subtitle') }}</p>
                <h1 class="text-4xl md:text-6xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n-html="home.hero_title">
                    {!! __('public.home.hero_title') !!}
                </h1>
                <p class="mt-4 text-lg md:text-xl text-neutral-600 dark:text-neutral-300 max-w-xl mx-auto md:mx-0 text-balance" data-i18n="home.hero_description">
                    {{ __('public.home.hero_description') }}
                </p>
                <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
                    <a href="/portfolio" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all" data-i18n="home.cta_portfolio">
                        {{ __('public.home.cta_portfolio') }}
                    </a>
                    <a href="/about" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-neutral-700 dark:text-neutral-200 bg-neutral-100 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all" data-i18n="home.cta_about">
                        {{ __('public.home.cta_about') }}
                    </a>
                </div>
            </div>
            <div class="shrink-0">
                <div class="w-48 h-48 md:w-64 md:h-64 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-400 p-1 shadow-lg">
                    <div class="w-full h-full rounded-xl bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center overflow-hidden">
                        <svg class="w-20 h-20 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Projects -->
<section class="py-16 md:py-24 bg-neutral-50 dark:bg-neutral-900 border-y border-neutral-200 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white" data-i18n="home.featured_projects_title">{{ __('public.home.featured_projects_title') }}</h2>
                <p class="mt-2 text-neutral-600 dark:text-neutral-300" data-i18n="home.featured_projects_desc">{{ __('public.home.featured_projects_desc') }}</p>
            </div>
            <a href="/portfolio" class="hidden md:inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors">
                <span data-i18n="common.see_all">{{ __('public.common.see_all') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($featuredProjects as $index => $project)
                <a href="/portfolio/{{ $project->slug }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ $index + 1 }}">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium {{ $project->type === 'pribadi' ? 'bg-primary-600/10 text-primary-600 border border-primary-600/20' : 'bg-primary-400/10 text-primary-400 border border-primary-400/20' }} backdrop-blur-sm">
                                {{ $project->type === 'pribadi' ? 'Pribadi' : $project->company_name }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">{{ $project->localize('title') }}</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">{{ $project->localize('short_description') }}</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">{{ $tech->technology_name }}</span>
                            @endforeach
                        </div>
                    </div>
                </a>
            @empty
                {{-- Fallback: 3 hardcoded placeholder cards from prototype --}}
                <a href="/portfolio" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">PT. Digital Nusantara</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Sistem ERP — Manajemen Inventori & Pengadaan</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Menganalisis alur bisnis inventory yang masih manual, merancang modul ERP dengan approval workflow 3-level, dan membangunnya langsung hingga production.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
                        </div>
                    </div>
                </a>
                <a href="/portfolio" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Pribadi</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">Dashboard Internal — Sentralisasi Laporan</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Mengidentifikasi pain point tim operasional yang menghabiskan 2 hari/minggu menggabungkan laporan Excel, lalu merancang dan membangun dashboard terpusat dengan automated data aggregation.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Livewire</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
                        </div>
                    </div>
                </a>
                <a href="/portfolio" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                        </div>
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Open Source</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">API Gateway Scaffold — Microservices Starter Kit</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Merancang dan membangun starter kit API Gateway reusable dengan JWT auth, rate limiting, dan OpenAPI docs untuk mempercepat setup proyek microservices.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Node.js</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Express</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Redis</span>
                        </div>
                    </div>
                </a>
            @endforelse
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-end justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white" data-i18n="home.latest_articles_title">{{ __('public.home.latest_articles_title') }}</h2>
                <p class="mt-2 text-neutral-600 dark:text-neutral-300" data-i18n="home.latest_articles_desc">{{ __('public.home.latest_articles_desc') }}</p>
            </div>
            <a href="/blog" class="hidden md:inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors">
                <span data-i18n="common.see_all">{{ __('public.common.see_all') }}</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Hardcoded placeholder article cards from prototype --}}
            <a href="/blog" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
                <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
                        <span class="text-xs text-neutral-500 dark:text-neutral-400">5 <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Setup Cursor IDE untuk Laravel Development</h3>
                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Konfigurasi Cursor dengan rules dan custom commands untuk scaffolding Laravel lebih cepat.</p>
                    <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">7 Mei 2026</p>
                </div>
            </a>
            <a href="/blog" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
                <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Case Study</span>
                        <span class="text-xs text-neutral-500 dark:text-neutral-400">8 <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Dari Spreadsheet ke Dashboard: Redesign Laporan Operasional</h3>
                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Breakdown proses analisis, perancangan data flow, dan development dashboard internal dengan Laravel.</p>
                    <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">1 Mei 2026</p>
                </div>
            </a>
            <a href="/blog" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
                <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Insight</span>
                        <span class="text-xs text-neutral-500 dark:text-neutral-400">6 <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Kenapa System Analyst Perlu Bisa Coding di 2026</h3>
                    <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Refleksi tentang perubahan peran System Analyst di era AI dan mengapa kemampuan eksekusi kode jadi krusial.</p>
                    <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">20 April 2026</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 md:py-24 bg-gradient-to-br from-primary-950 via-primary-900 to-primary-600">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white" data-i18n="home.cta_section_title">{{ __('public.home.cta_section_title') }}</h2>
        <p class="mt-4 text-lg text-white/80 text-balance" data-i18n="home.cta_section_desc">{{ __('public.home.cta_section_desc') }}</p>
        <div class="mt-8 flex flex-wrap justify-center gap-3">
            <a href="/contact" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-primary-900 bg-white hover:bg-neutral-100 shadow-sm transition-all" data-i18n="home.cta_contact">{{ __('public.home.cta_contact') }}</a>
            <a href="/about" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white border border-white/30 hover:bg-white/10 transition-all" data-i18n="home.cta_learn_more">{{ __('public.home.cta_learn_more') }}</a>
        </div>
    </div>
</section>

@endsection
