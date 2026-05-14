@extends('layouts.public')

@section('title', ($seo['title'] ?? __('public.blog.page_title')) . ' — ' . config('app.name'))
@section('description', $seo['description'] ?? 'Artikel seputar teknologi, sistem, dan pengembangan oleh Amrizal — System Analyst & Builder.')

@section('content')

<!-- Hero -->
<section class="hero-aurora pt-32 pb-12 md:pt-40 md:pb-16 bg-neutral-50 dark:bg-neutral-950">
    <x-aurora-background />
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="max-w-2xl">
            <x-glass-container class="p-6 md:p-8">
                <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase" data-i18n="blog.page_title">{{ __('public.blog.page_title') }}</p>
                <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance" data-i18n="blog.hero_title">
                    {{ __('public.blog.hero_title') }}
                </h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance" data-i18n="blog.hero_desc">
                    {{ __('public.blog.hero_desc') }}
                </p>
            </x-glass-container>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="pb-8 md:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2" id="blog-filters">
                <button data-filter="all" class="px-4 py-1.5 rounded-full text-sm font-medium bg-primary-600 text-white transition-colors" data-i18n="common.all">{{ __('public.common.all') }}</button>
                @foreach ($categories as $category)
                    <button data-filter="{{ $category->slug }}" class="px-4 py-1.5 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors">{{ $category->name }}</button>
                @endforeach
            </div>
            <div class="relative w-full sm:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" id="blog-search" placeholder="{{ __('public.blog.search_placeholder') }}" class="w-full sm:w-64 pl-9 pr-4 py-2 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border border-transparent focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all text-neutral-900 dark:text-white placeholder:text-neutral-500">
            </div>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="blog-grid">
            @forelse ($posts as $index => $post)
                <a href="{{ route('blog.show', $post->slug) }}" data-post data-category="{{ $post->category?->slug ?? '' }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ ($index % 3) + 1 }}">
                    <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        @if ($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->localize('title') }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            @if ($post->category)
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">{{ $post->category->name }}</span>
                            @endif
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} <span data-i18n="common.min_read">{{ __('public.common.min_read') }}</span></span>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 group-hover:underline transition-colors line-clamp-2">{{ $post->localize('title') }}</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($post->localize('content')), 150) }}</p>
                        <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }}</p>
                    </div>
                </a>
            @empty
                <div id="blog-empty" class="col-span-full text-center py-12 text-neutral-500" data-i18n="blog.no_articles">{{ __('public.blog.no_articles') }}</div>
            @endforelse
        </div>

        <div id="blog-no-results" class="hidden col-span-full text-center py-16">
            <svg class="w-12 h-12 mx-auto text-neutral-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <p class="text-neutral-500 dark:text-neutral-400" data-i18n="blog.no_results">{{ __('public.blog.no_results') }}</p>
        </div>

        <!-- Pagination -->
        <div id="blog-pagination" class="mt-12 flex items-center justify-center gap-2"></div>
    </div>
</section>

@endsection

@push('scripts')
<script>
(function() {
    const POSTS_PER_PAGE = 9;
    let currentPage = 1;
    let activeCategory = 'all';
    let searchQuery = '';

    const filterButtons = document.querySelectorAll('#blog-filters button');
    const searchInput = document.getElementById('blog-search');
    const grid = document.getElementById('blog-grid');
    const paginationContainer = document.getElementById('blog-pagination');
    const noResults = document.getElementById('blog-no-results');

    function getVisibleCards() {
        return Array.from(grid.querySelectorAll('a[data-post]')).filter(card => {
            const category = card.dataset.category || '';
            const text = card.textContent.toLowerCase();

            const matchCategory = activeCategory === 'all' || category === activeCategory;
            const matchSearch = !searchQuery || text.includes(searchQuery);

            return matchCategory && matchSearch;
        });
    }

    function render() {
        const allCards = Array.from(grid.querySelectorAll('a[data-post]'));
        const visibleCards = getVisibleCards();
        const totalPages = Math.max(1, Math.ceil(visibleCards.length / POSTS_PER_PAGE));

        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        // Show/hide cards based on pagination
        allCards.forEach(card => {
            card.style.display = 'none';
            card.classList.remove('visible');
        });
        visibleCards.forEach((card, index) => {
            const pageNum = Math.floor(index / POSTS_PER_PAGE) + 1;
            if (pageNum === currentPage) {
                card.style.display = '';
                requestAnimationFrame(() => card.classList.add('visible'));
            }
        });

        // Show/hide no results message
        if (visibleCards.length === 0) {
            noResults.classList.remove('hidden');
            paginationContainer.innerHTML = '';
        } else {
            noResults.classList.add('hidden');
            renderPagination(totalPages, visibleCards.length);
        }
    }

    function renderPagination(totalPages, totalItems) {
        if (totalPages <= 1) {
            paginationContainer.innerHTML = '';
            return;
        }

        let html = '';

        // Prev button
        if (currentPage > 1) {
            html += `<button data-page="${currentPage - 1}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-600 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:text-primary-600 hover:border-primary-600 transition">←</button>`;
        } else {
            html += `<span class="inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-300 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg cursor-not-allowed">←</span>`;
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                html += `<span class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-primary-600 rounded-lg">${i}</span>`;
            } else {
                html += `<button data-page="${i}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-neutral-600 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:text-primary-600 hover:border-primary-600 hover:bg-primary-50 transition">${i}</button>`;
            }
        }

        // Next button
        if (currentPage < totalPages) {
            html += `<button data-page="${currentPage + 1}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-600 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg hover:text-primary-600 hover:border-primary-600 transition">→</button>`;
        } else {
            html += `<span class="inline-flex items-center px-3 py-2 text-sm font-medium text-neutral-300 bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-700 rounded-lg cursor-not-allowed">→</span>`;
        }

        paginationContainer.innerHTML = html;

        // Attach click handlers to new pagination buttons
        paginationContainer.querySelectorAll('button[data-page]').forEach(btn => {
            btn.addEventListener('click', function() {
                currentPage = parseInt(this.dataset.page);
                render();
                grid.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });
    }

    function setActiveFilterButton(slug) {
        filterButtons.forEach(btn => {
            const isActive = btn.dataset.filter === slug;
            btn.classList.toggle('bg-primary-600', isActive);
            btn.classList.toggle('text-white', isActive);
            btn.classList.toggle('bg-neutral-100', !isActive);
            btn.classList.toggle('dark:bg-neutral-800', !isActive);
            btn.classList.toggle('text-neutral-600', !isActive);
            btn.classList.toggle('dark:text-neutral-300', !isActive);
            btn.classList.toggle('hover:bg-neutral-200', !isActive);
            btn.classList.toggle('dark:hover:bg-neutral-700', !isActive);
        });
    }

    // Category filter
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            activeCategory = this.dataset.filter;
            currentPage = 1;
            setActiveFilterButton(activeCategory);
            render();
        });
    });

    // Search
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchQuery = this.value.toLowerCase().trim();
            currentPage = 1;
            render();
        });
    }

    // Initial render
    render();
})();
</script>
@endpush
