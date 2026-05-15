@extends('layouts.public')

@section('title', ($seo['title'] ?? $post->localize('title')) . ' — ' . config('app.name'))
@section('description', $seo['description'] ?? \Illuminate\Support\Str::limit(strip_tags($post->localize('content')), 160))
@section('og_type', 'article')
@section('og_image', $seo['og_image'] ?? config('seo.default_image'))
@section('canonical_url', $seo['canonical_url'] ?? route('blog.show', $post->slug))
@section('meta_author', $seo['meta_author'] ?? config('seo.author'))

@section('content')

<section class="hero-aurora pt-24 pb-8 md:pt-28 md:pb-12 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <x-glass-container class="p-6 md:p-8">
            <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1 text-sm text-neutral-500 dark:text-neutral-400 hover:text-primary-600 transition-colors mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span data-i18n="blog.back_to_blog">{{ __('public.blog.back_to_blog') }}</span>
            </a>
            <div class="flex flex-wrap items-center gap-2 mb-4">
                @if ($post->category)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">{{ $post->category->name }}</span>
                @endif
                <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }} · {{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span> · <span class="inline-flex items-center gap-0.5">{{ number_format($post->views) }} <span data-i18n="common.views">{{ __('public.common.views') }}</span></span></span>
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">{{ $post->localize('title') }}</h1>
            @if ($post->author?->name)
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance"><span data-i18n="blog.written_by">{{ __('public.blog.written_by') }}</span> {{ $post->author->name }}</p>
            @endif
        </x-glass-container>
    </div>
</section>

<!-- Content Language Notice -->
@if(app()->getLocale() === 'en' && !$post->hasTranslation('title'))
<section class="pb-6 md:pb-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-primary-50 dark:bg-primary-900/10 border border-primary-200 dark:border-primary-800 text-primary-700 dark:text-primary-400 text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span data-i18n="blog.content_only_in_id">{{ __('public.blog.content_only_in_id') }}</span>
        </div>
    </div>
</section>
@endif

<!-- Thumbnail -->
@if ($post->thumbnail)
<section class="pb-10 md:pb-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="aspect-[16/9] bg-neutral-200 dark:bg-neutral-800 rounded-xl overflow-hidden flex items-center justify-center group">
            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->localize('title') }}" width="1280" height="720" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
    </div>
</section>
@endif

<!-- Article Content -->
<section class="pb-16 md:pb-24">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-animate article-content text-neutral-800 dark:text-neutral-200" data-delay="1">
            {!! $post->localize('content') !!}
        </div>

        <!-- Tags -->
        @if ($post->tags->count() > 0)
        <div class="mt-10 pt-8 border-t border-neutral-200 dark:border-neutral-800 card-animate" data-delay="2">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-sm text-neutral-500 dark:text-neutral-400" data-i18n="common.tag">{{ __('public.common.tag') }}:</span>
                @foreach ($post->tags as $tag)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700 hover:border-primary-600/30 hover:text-primary-600 transition-colors">{{ $tag->name }}</span>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Share -->
        <div class="mt-8 card-animate" data-delay="2">
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
    </div>
</section>

<!-- Prev / Next -->
@if ($previousPost || $nextPost)
<section class="pb-10 md:pb-14 border-t border-neutral-200 dark:border-neutral-800">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            @if ($previousPost)
                <a href="{{ route('blog.show', $previousPost->slug) }}" class="group flex items-center gap-3 text-left">
                    <svg class="w-5 h-5 text-neutral-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    <div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400" data-i18n="common.previous_article">{{ __('public.common.previous_article') }}</p>
                        <p class="text-sm font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-1">{{ $previousPost->localize('title') }}</p>
                    </div>
                </a>
            @else
                <div></div>
            @endif
            @if ($nextPost)
                <a href="{{ route('blog.show', $nextPost->slug) }}" class="group flex items-center gap-3 text-right sm:flex-row-reverse self-end sm:self-auto">
                    <svg class="w-5 h-5 text-neutral-400 group-hover:text-primary-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    <div>
                        <p class="text-xs text-neutral-500 dark:text-neutral-400" data-i18n="common.next_article">{{ __('public.common.next_article') }}</p>
                        <p class="text-sm font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-1">{{ $nextPost->localize('title') }}</p>
                    </div>
                </a>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Related Posts -->
@if ($relatedPosts->count() > 0)
<section class="pb-10 md:pb-14">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-xl font-bold text-neutral-900 dark:text-white mb-6" data-i18n="common.related">{{ __('public.common.related') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach ($relatedPosts as $related)
                <a href="{{ route('blog.show', $related->slug) }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ $loop->index + 1 }}">
                    <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        @if ($related->thumbnail)
                            <img src="{{ Storage::url($related->thumbnail) }}" alt="{{ $related->localize('title') }}" loading="lazy" width="640" height="400" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            @if ($related->category)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-medium bg-primary-600/10 text-primary-600">{{ $related->category->name }}</span>
                            @endif
                            <span class="text-[10px] text-neutral-500 dark:text-neutral-400">{{ ceil(str_word_count(strip_tags($related->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
                        </div>
                        <h3 class="text-sm font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">{{ $related->localize('title') }}</h3>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        var feedback = document.getElementById('copy-feedback');
        if (feedback) {
            feedback.classList.remove('hidden');
            setTimeout(function() {
                feedback.classList.add('hidden');
            }, 2500);
        }
    });
}
</script>
@endpush

@push('jsonld')
    <x-schema-org type="NewsArticle" :data="[
        'headline' => $post->localize('title'),
        'description' => \App\Helpers\SeoHelper::metaDescription($post->localize('content')),
        'image' => $post->thumbnail ? [\App\Helpers\SeoHelper::ogImage($post->thumbnail)] : [config('seo.default_image')],
        'datePublished' => $post->published_at?->toIso8601String(),
        'dateModified' => $post->updated_at->toIso8601String(),
        'author' => [
            '@type' => 'Person',
            'name' => $post->author?->name ?? config('seo.author'),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => config('seo.site_name'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => config('seo.default_image'),
            ],
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blog.show', $post->slug),
        ],
    ]" />
    <x-breadcrumb-schema :items="[
        ['name' => __('public.nav.home'), 'url' => url('/')],
        ['name' => __('public.nav.blog'), 'url' => route('blog.index')],
        ['name' => $post->localize('title')],
    ]" />
@endpush
