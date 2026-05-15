@extends('layouts.public')

@section('title', ($project ? $project->localize('title') : __('public.common.project_description')) . ' — ' . __('public.portfolio.page_title') . ' — ' . config('app.name'))
@section('description', $project ? \App\Helpers\SeoHelper::metaDescription($project->localize('short_description')) : 'Detail proyek oleh Amrizal — System Analyst & Builder.')
@section('og_image', $project ? \App\Helpers\SeoHelper::ogImage($project->thumbnail) : config('seo.default_image'))
@section('canonical_url', $project ? route('portfolio.show', $project->slug) : route('portfolio.index'))

@section('content')

<section class="hero-aurora pt-24 pb-8 md:pt-28 md:pb-12 bg-neutral-50 dark:bg-neutral-950">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <x-glass-container class="p-6 md:p-8">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-primary-600 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span data-i18n="portfolio.back_to_portfolio">{{ __('public.portfolio.back_to_portfolio') }}</span>
            </a>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if ($project->company_name)
                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20">
                        {{ $project->company_name }}
                    </span>
                @endif
                <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $project->type }}</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">{{ $project->localize('title') }}</h1>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-neutral-600 dark:text-neutral-300">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    {{ $project->period }}
                </div>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    {{ $project->role }}
                </div>
            </div>
        </x-glass-container>
    </div>
</section>

@if(app()->getLocale() === 'en' && !$project->hasTranslation('title'))
<section class="py-6 md:py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary-50 dark:bg-primary-900/10 border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-primary-400 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span data-i18n="portfolio.content_only_in_id">{{ __('public.portfolio.content_only_in_id') }}</span>
        </div>
    </div>
</section>
@endif

<!-- Thumbnail -->
<section class="py-10 md:py-14">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-animate aspect-video bg-neutral-200 dark:bg-neutral-800 rounded-xl overflow-hidden flex items-center justify-center group" data-delay="1">
            @if ($project->thumbnail)
                <img src="{{ Storage::url($project->thumbnail) }}" alt="{{ $project->localize('title') }}" width="1280" height="720" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            @else
                <svg class="w-24 h-24 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
            @endif
        </div>
    </div>
</section>

<!-- Content -->
<section class="pb-16 md:pb-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card-animate" data-delay="1">
                    <h2 class="text-xl font-semibold text-neutral-900 dark:text-white mb-3" data-i18n="common.project_description">{{ __('public.common.project_description') }}</h2>
                    <div class="prose dark:prose-invert max-w-none text-neutral-700 dark:text-neutral-300 leading-relaxed space-y-4">
                        {!! $project->localize('full_description') !!}
                    </div>
                </div>

                @if ($project->gallery && count($project->gallery) > 0)
                    <div class="card-animate" data-delay="2">
                        <h2 class="text-xl font-semibold text-neutral-900 dark:text-white mb-3" data-i18n="common.gallery">{{ __('public.common.gallery') }}</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($project->gallery as $image)
                                <div class="aspect-video bg-neutral-200 dark:bg-neutral-800 rounded-lg overflow-hidden flex items-center justify-center group">
                                    <img src="{{ Storage::url($image) }}" alt="{{ $project->localize('title') }} - Gallery image {{ $loop->iteration }}" loading="lazy" width="800" height="450" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="space-y-6">
                @if ($project->demo_url || $project->repo_url)
                    <div class="card-animate bg-neutral-50 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
                        <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wide mb-4" data-i18n="common.links">{{ __('public.common.links') }}</h3>
                        <div class="space-y-3">
                            @if ($project->demo_url)
                                <a href="{{ $project->demo_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 px-3 py-2 -mx-3 -my-2 rounded-lg text-sm font-medium text-primary-600 hover:text-primary-900 hover:bg-primary-50 dark:hover:bg-primary-900/10 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span data-i18n="common.view_demo">{{ __('public.common.view_demo') }}</span>
                                </a>
                            @endif
                            @if ($project->repo_url)
                                <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm font-medium text-primary-600 hover:text-primary-900 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                    <span data-i18n="common.repository">{{ __('public.common.repository') }}</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="card-animate bg-neutral-50 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
                    <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wide mb-4" data-i18n="common.share">{{ __('public.common.share') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="copyLink()" class="w-9 h-9 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-primary-600 hover:text-white transition-colors" title="{{ __('public.common.copy_link') }}" data-i18n-attr="title:common.copy_link">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        </button>
                        <a href="https://twitter.com/intent/tweet?url=" onclick="this.href='https://twitter.com/intent/tweet?url='+encodeURIComponent(window.location.href)+'&text='+encodeURIComponent(document.title)" target="_blank" rel="noopener" class="w-9 h-9 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-[#1DA1F2] hover:text-white transition-colors" title="{{ __('public.common.share') }} X" data-i18n-attr="title:common.share">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=" onclick="this.href='https://www.linkedin.com/sharing/share-offsite/?url='+encodeURIComponent(window.location.href)" target="_blank" rel="noopener" class="w-9 h-9 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-[#0A66C2] hover:text-white transition-colors" title="{{ __('public.common.share') }} LinkedIn" data-i18n-attr="title:common.share">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://wa.me/?text=" onclick="this.href='https://wa.me/?text='+encodeURIComponent(document.title+' '+window.location.href)" target="_blank" rel="noopener" class="w-9 h-9 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-[#25D366] hover:text-white transition-colors" title="{{ __('public.common.share') }} WhatsApp" data-i18n-attr="title:common.share">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=" onclick="this.href='https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href)" target="_blank" rel="noopener" class="w-9 h-9 flex items-center justify-center rounded-lg bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-[#1877F2] hover:text-white transition-colors" title="{{ __('public.common.share') }} Facebook" data-i18n-attr="title:common.share">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    </div>
                    <p id="copy-feedback" class="mt-3 text-xs text-primary-600 hidden" data-i18n="common.copied">{{ __('public.common.copied') }}</p>
                </div>

                @if ($project->technologies->count() > 0)
                    <div class="card-animate bg-neutral-50 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
                        <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wide mb-4" data-i18n="common.technologies">{{ __('public.common.technologies') }}</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-700 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">{{ $tech->technology_name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($project->members->count() > 0)
                    <div class="card-animate bg-neutral-50 dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
                        <h3 class="text-sm font-semibold text-neutral-900 dark:text-white uppercase tracking-wide mb-4" data-i18n="common.team">{{ __('public.common.team') }}</h3>
                        <ul class="space-y-2 text-sm text-neutral-600 dark:text-neutral-300">
                            @foreach ($project->members as $member)
                                <li class="flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary-600"></span>
                                    @if ($member->role)
                                        {{ $member->role }} — {{ $member->name }}
                                    @else
                                        {{ $member->name }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</section>

<!-- Prev / Next -->
@if ($previousProject || $nextProject)
<section class="pb-10 md:pb-14 border-t border-neutral-200 dark:border-neutral-800">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            @if ($previousProject)
                <a href="{{ route('portfolio.show', $previousProject->slug) }}" class="group flex items-center gap-3 text-left">
                    <svg class="w-5 h-5 text-neutral-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400" data-i18n="common.previous_project">{{ __('public.common.previous_project') }}</p>
                        <p class="text-sm font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-1">{{ $previousProject->localize('title') }}</p>
                    </div>
                </a>
            @else
                <div></div>
            @endif
            @if ($nextProject)
                <a href="{{ route('portfolio.show', $nextProject->slug) }}" class="group flex items-center gap-3 text-right sm:flex-row-reverse self-end sm:self-auto">
                    <svg class="w-5 h-5 text-neutral-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400" data-i18n="common.next_project">{{ __('public.common.next_project') }}</p>
                        <p class="text-sm font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-1">{{ $nextProject->localize('title') }}</p>
                    </div>
                </a>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Related Projects -->
@if ($relatedProjects->count() > 0)
    <section class="pb-16 md:pb-24 border-t border-neutral-200 dark:border-neutral-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
            <h2 class="text-2xl md:text-3xl font-bold text-neutral-900 dark:text-white mb-8" data-i18n="common.related">{{ __('public.common.related') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($relatedProjects as $index => $related)
                    <a href="{{ route('portfolio.show', $related->slug) }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ $index + 1 }}">
                        <div class="relative aspect-video bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                            @if ($related->thumbnail)
                                <img src="{{ Storage::url($related->thumbnail) }}" alt="{{ $related->localize('title') }}" loading="lazy" width="640" height="360" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                                </div>
                            @endif
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-primary-400/10 text-primary-400 border border-primary-400/20 backdrop-blur-sm">
                                    {{ $related->company_name ?: $related->type }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors">{{ $related->localize('title') }}</h3>
                            <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-3">{{ $related->localize('short_description') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif

@endsection

@push('jsonld')
    <x-schema-org type="CreativeWork" :data="[
        'name' => $project->localize('title'),
        'description' => \App\Helpers\SeoHelper::metaDescription($project->localize('short_description')),
        'image' => $project->thumbnail ? [\App\Helpers\SeoHelper::ogImage($project->thumbnail)] : [config('seo.default_image')],
        'dateCreated' => $project->created_at->toIso8601String(),
        'dateModified' => $project->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => config('seo.author'),
        ],
        'url' => route('portfolio.show', $project->slug),
    ]" />
    <x-breadcrumb-schema :items="[
        ['name' => __('public.nav.home'), 'url' => url('/')],
        ['name' => __('public.nav.portfolio'), 'url' => route('portfolio.index')],
        ['name' => $project->localize('title')],
    ]" />
@endpush

@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const feedback = document.getElementById('copy-feedback');
        if (feedback) {
            feedback.classList.remove('hidden');
            setTimeout(() => feedback.classList.add('hidden'), 2000);
        }
    });
}
</script>
@endpush
