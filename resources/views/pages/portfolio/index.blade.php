@extends('layouts.public')

@section('title', __('public.portfolio.page_title') . ' — ' . config('app.name'))
@section('description', 'Portofolio proyek dan sertifikat Amrizal — System Analyst & Builder.')

@section('content')

<!-- Header -->
<section class="hero-aurora pt-32 pb-12 md:pt-40 md:pb-16 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <x-glass-container class="p-6 md:p-8">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="portfolio.page_title">{{ __('public.portfolio.page_title') }}</p>
                <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n="portfolio.hero_title">{{ __('public.portfolio.hero_title') }}</h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance" data-i18n="portfolio.hero_desc">{{ __('public.portfolio.hero_desc') }}</p>
            </x-glass-container>
        </div>
    </div>
</section>

<!-- Filters -->
<section id="portfolio-filters" class="pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <button id="filter-all" class="px-4 py-1.5 rounded-full text-sm font-medium bg-primary-600 text-white" data-i18n="common.all">{{ __('public.common.all') }}</button>
                <button id="filter-projects" class="px-4 py-1.5 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors" data-i18n="common.projects">{{ __('public.common.projects') }}</button>
                <button id="filter-certificates" class="px-4 py-1.5 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors" data-i18n="common.certificates">{{ __('public.common.certificates') }}</button>
            </div>
            <div class="relative w-full sm:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" id="portfolio-search-input" placeholder="{{ __('public.portfolio.search_placeholder') }}" class="w-full sm:w-64 pl-9 pr-4 py-2 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border border-transparent focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all text-neutral-900 dark:text-white placeholder:text-neutral-500">
            </div>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section id="projects-section" class="pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="projects-grid">
            @forelse ($projects as $index => $project)
                <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ ($index % 3) + 1 }}">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        @if ($project->thumbnail)
                            <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->localize('title') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="absolute inset-0 flex items-center justify-center">
                                <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            </div>
                        @endif
                        <div class="absolute top-3 left-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">
                                {{ $project->company_name ?: $project->type }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="hover:underline">{{ $project->localize('title') }}</a>
                        </h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">{{ $project->localize('short_description') }}</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">{{ $tech->technology_name }}</span>
                            @endforeach
                        </div>
                        <div class="mt-5 flex items-center gap-3">
                            <a href="{{ route('portfolio.show', $project->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span data-i18n="common.detail">{{ __('public.common.detail') }}</span>
                            </a>
                            @if ($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 px-2.5 py-1 -mx-1 rounded-md text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    <span data-i18n="common.live_demo">{{ __('public.common.live_demo') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </article>
            @empty
                {{-- Fallback: 3 hardcoded placeholder cards --}}
                <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg></div>
                        <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">Retail / e-Commerce</span></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="#" class="hover:underline">Platform Omnichannel E-Commerce</a></h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Memimpin analisis kebutuhan dan perancangan arsitektur platform e-commerce terintegrasi yang menyatukan kanal online, POS toko fisik, dan manajemen gudang dalam satu ekosistem data real-time untuk 40+ toko.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Microservices</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">RabbitMQ</span>
                        </div>
                        <div class="mt-5 flex items-center gap-3">
                            <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
                            <a href="#" class="inline-flex items-center gap-1.5 px-2.5 py-1 -mx-1 rounded-md text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>Live Demo</a>
                        </div>
                    </div>
                </article>

                <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                        <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Logistik Internal</span></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="#" class="hover:underline">Sistem Manajemen Gudang (WMS)</a></h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Memetakan alur kerja gudang manual ke sistem terotomasi, merancang WMS dengan proses inbound, putaway, picking, packing, dan outbound berbasis barcode scanning untuk 3 gudang regional.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Laravel</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
                        </div>
                        <div class="mt-5 flex items-center gap-3">
                            <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
                            <a href="#" class="inline-flex items-center gap-1.5 px-2.5 py-1 -mx-1 rounded-md text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>Live Demo</a>
                        </div>
                    </div>
                </article>

                <article class="card-animate group bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
                    <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center"><svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg></div>
                        <div class="absolute top-3 left-3"><span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20 backdrop-blur-sm">Logistik / Supply Chain</span></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors"><a href="#" class="hover:underline">Sistem Pengiriman Last-Mile & Tracking</a></h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">Merancang ekosistem pengiriman last-mile terintegrasi meliputi dispatch console, driver mobile app, dan customer tracking portal dengan live tracking dan otomasi assign order berbasis zona.</p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Node.js</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">WebSocket</span>
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Flutter</span>
                        </div>
                        <div class="mt-5 flex items-center gap-3">
                            <a href="#" class="inline-flex items-center gap-1.5 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>Detail</a>
                            <a href="#" class="inline-flex items-center gap-1.5 px-2.5 py-1 -mx-1 rounded-md text-sm font-medium text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-50 dark:hover:bg-primary-900/10 transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>Live Demo</a>
                        </div>
                    </div>
                </article>
            @endforelse

            <!-- Empty State: Projects -->
            <div id="projects-empty" class="hidden col-span-full py-16 text-center">
                <svg class="w-12 h-12 mx-auto text-neutral-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <p class="text-neutral-500 dark:text-neutral-400" data-i18n="portfolio.no_results">{{ __('public.portfolio.no_results') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Certificates Section -->
<section id="certificates-section" class="py-16 md:py-24 bg-neutral-50 dark:bg-neutral-900 border-y border-neutral-200 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10" data-i18n="common.certificates">{{ __('public.common.certificates') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="certificates-grid">
            @forelse ($certificates as $index => $certificate)
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="{{ ($index % 3) + 1 }}">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700">
                            @if ($certificate->issuer_logo)
                                <img src="{{ Storage::url($certificate->issuer_logo) }}" alt="{{ $certificate->issuer_name }}" class="w-6 h-6 object-contain">
                            @else
                                <svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-neutral-900 dark:text-white">{{ $certificate->localize('title') }}</h3>
                            <p class="text-sm text-primary-600">{{ $certificate->issuer_name }}</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">
                                <span data-i18n="portfolio.issued">{{ __('public.portfolio.issued') }}</span>: {{ $certificate->issued_at->format('M Y') }}
                                @if ($certificate->expired_at)
                                    &middot; <span data-i18n="portfolio.valid_until">{{ __('public.portfolio.valid_until') }}</span> {{ $certificate->expired_at->format('M Y') }}
                                @endif
                            </p>
                            @if ($certificate->verify_url)
                                <a href="{{ $certificate->verify_url }}" target="_blank" rel="noopener" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span data-i18n="common.verify">{{ __('public.common.verify') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- Fallback: 4 hardcoded certificate cards --}}
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="1">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-neutral-900 dark:text-white">AWS Certified Solutions Architect</h3>
                            <p class="text-sm text-primary-600">Amazon Web Services</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Maret 2025 &middot; Berlaku s/d Maret 2028</p>
                            <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
                        </div>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="2">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-neutral-900 dark:text-white">Laravel Certified Developer</h3>
                            <p class="text-sm text-primary-600">Laravel LLC</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Agustus 2024</p>
                            <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
                        </div>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="3">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-neutral-900 dark:text-white">AI Engineering Fundamentals</h3>
                            <p class="text-sm text-primary-600">DeepLearning.AI</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Januari 2026</p>
                            <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
                        </div>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 shadow-sm hover:shadow-md transition-all" data-delay="1">
                    <div class="flex items-start gap-4">
                        <div class="shrink-0 w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg></div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-neutral-900 dark:text-white">Scrum Foundation Professional Certificate</h3>
                            <p class="text-sm text-primary-600">CertiProf</p>
                            <p class="text-xs text-neutral-500 dark:text-neutral-400 mt-1">Diterbitkan: Juni 2023</p>
                            <a href="#" class="inline-flex items-center gap-1 mt-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>Verifikasi</a>
                        </div>
                    </div>
                </div>
            @endforelse

            <!-- Empty State: Certificates -->
            <div id="certificates-empty" class="hidden col-span-full py-16 text-center">
                <svg class="w-12 h-12 mx-auto text-neutral-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <p class="text-neutral-500 dark:text-neutral-400" data-i18n="portfolio.no_results">{{ __('public.portfolio.no_results') }}</p>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
    const filterAll = document.getElementById('filter-all');
    const filterProjects = document.getElementById('filter-projects');
    const filterCertificates = document.getElementById('filter-certificates');
    const projectsSection = document.getElementById('projects-section');
    const certificatesSection = document.getElementById('certificates-section');

    function setActiveFilter(activeBtn) {
        [filterAll, filterProjects, filterCertificates].forEach(btn => {
            if (!btn) return;
            btn.classList.remove('bg-primary-600', 'text-white');
            btn.classList.add('bg-neutral-100', 'dark:bg-neutral-800', 'text-neutral-600', 'dark:text-neutral-300', 'hover:bg-neutral-200', 'dark:hover:bg-neutral-700');
        });
        activeBtn.classList.remove('bg-neutral-100', 'dark:bg-neutral-800', 'text-neutral-600', 'dark:text-neutral-300', 'hover:bg-neutral-200', 'dark:hover:bg-neutral-700');
        activeBtn.classList.add('bg-primary-600', 'text-white');
    }

    function showFilter(filter) {
        if (!projectsSection || !certificatesSection) return;
        if (filter === 'all') {
            projectsSection.classList.remove('hidden');
            certificatesSection.classList.remove('hidden');
        } else if (filter === 'projects') {
            projectsSection.classList.remove('hidden');
            certificatesSection.classList.add('hidden');
        } else {
            projectsSection.classList.add('hidden');
            certificatesSection.classList.remove('hidden');
        }
    }

    if (filterAll) filterAll.addEventListener('click', () => { setActiveFilter(filterAll); showFilter('all'); });
    if (filterProjects) filterProjects.addEventListener('click', () => { setActiveFilter(filterProjects); showFilter('projects'); });
    if (filterCertificates) filterCertificates.addEventListener('click', () => { setActiveFilter(filterCertificates); showFilter('certificates'); });

    // Search
    const searchInput = document.getElementById('portfolio-search-input');
    const projectsEmpty = document.getElementById('projects-empty');
    const certificatesEmpty = document.getElementById('certificates-empty');

    function updateEmptyStates() {
        const projectCards = document.querySelectorAll('#projects-grid > article, #projects-grid > a');
        const certificateCards = document.querySelectorAll('#certificates-grid > div.card-animate');

        const anyProjectVisible = Array.from(projectCards).some(c => c.style.display !== 'none');
        const anyCertificateVisible = Array.from(certificateCards).some(c => c.style.display !== 'none');

        if (projectsEmpty) projectsEmpty.classList.toggle('hidden', anyProjectVisible);
        if (certificatesEmpty) certificatesEmpty.classList.toggle('hidden', anyCertificateVisible);
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            const projectCards = document.querySelectorAll('#projects-grid > article, #projects-grid > a');
            const certificateCards = document.querySelectorAll('#certificates-grid > div.card-animate');

            projectCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? '' : 'none';
            });

            certificateCards.forEach(card => {
                const text = card.textContent.toLowerCase();
                card.style.display = text.includes(query) ? '' : 'none';
            });

            updateEmptyStates();
        });
    }
})();
</script>
@endpush
