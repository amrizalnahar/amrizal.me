@extends('layouts.public')

@section('title', ($seo['title'] ?? 'Blog') . ' — ' . config('app.name'))
@section('description', $seo['description'] ?? 'Artikel seputar teknologi, sistem, dan pengembangan oleh Amrizal — System Analyst & Builder.')

@section('content')

<!-- Hero -->
<section class="pt-32 pb-12 md:pt-40 md:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase">Blog</p>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">
                Tulisan & Catatan
            </h1>
            <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance">
                Berbagi pengalaman, insight, dan tutorial seputar analisis sistem, arsitektur aplikasi, dan pengembangan software.
            </p>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="pb-8 md:pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <button class="px-4 py-1.5 rounded-full text-sm font-medium bg-primary-600 text-white">Semua</button>
                @foreach ($categories as $category)
                    <button class="px-4 py-1.5 rounded-full text-sm font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 hover:bg-neutral-200 dark:hover:bg-neutral-700 transition-colors">{{ $category->name }}</button>
                @endforeach
            </div>
            <div class="relative w-full sm:w-auto">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari artikel..." class="w-full sm:w-64 pl-9 pr-4 py-2 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border border-transparent focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all text-neutral-900 dark:text-white placeholder:text-neutral-500">
            </div>
        </div>
    </div>
</section>

<!-- Articles Grid -->
<section class="pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $index => $post)
                <a href="{{ route('blog.show', $post->slug) }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="{{ ($index % 3) + 1 }}">
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
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">{{ ceil(str_word_count(strip_tags($post->localize('content'))) / 200) }} menit baca</span>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">{{ $post->localize('title') }}</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($post->localize('content')), 150) }}</p>
                        <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">{{ $post->published_at?->format('d M Y') }}</p>
                    </div>
                </a>
            @empty
                {{-- Fallback: hardcoded placeholder cards from prototype --}}
                <a href="{{ route('blog.index') }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="1">
                    <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z"/></svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">5 menit baca</span>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Setup Cursor IDE untuk Laravel Development</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Konfigurasi Cursor dengan rules dan custom commands untuk scaffolding Laravel lebih cepat.</p>
                        <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">7 Mei 2026</p>
                    </div>
                </a>
                <a href="{{ route('blog.index') }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="2">
                    <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M9.4 16.6L4.8 12l4.6-4.6L8 6l-6 6 6 6 1.4-1.4zm5.2 0l4.6-4.6-4.6-4.6L16 6l6 6-6 6-1.4-1.4z"/></svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Workflow</span>
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">6 menit baca</span>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Dari Analisis ke Kode dalam 1 Hari dengan AI Tools</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Cara saya memanfaatkan Claude Code dan Cursor untuk mempercepat pipeline dari requirement ke prototype.</p>
                        <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">5 Mei 2026</p>
                    </div>
                </a>
                <a href="{{ route('blog.index') }}" class="card-animate group block bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 shadow-sm hover:shadow-md dark:hover:shadow-lg dark:hover:shadow-white/5 hover:-translate-y-1 transition-all duration-300 overflow-hidden" data-delay="3">
                    <div class="aspect-[16/10] bg-neutral-200 dark:bg-neutral-800 overflow-hidden">
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600">Tutorial</span>
                            <span class="text-xs text-neutral-500 dark:text-neutral-400">8 menit baca</span>
                        </div>
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white group-hover:text-primary-600 transition-colors line-clamp-2">Pattern Repository vs Service Layer di Laravel</h3>
                        <p class="mt-2 text-sm text-neutral-600 dark:text-neutral-300 line-clamp-2">Kapan menggunakan Repository Pattern dan kapan cukup Service Layer untuk menjaga kode tetap bersih.</p>
                        <p class="mt-4 text-xs text-neutral-500 dark:text-neutral-400">28 April 2026</p>
                    </div>
                </a>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($posts->hasPages())
            <div class="mt-12 flex items-center justify-center gap-2">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
</section>

@endsection
