@extends('layouts.public')

@section('title', 'Tentang Saya — ' . config('app.name'))
@section('description', 'Profil, pengalaman, dan keahlian Amrizal sebagai System Analyst & Builder.')

@section('content')

<!-- Hero About -->
<section class="pt-32 pb-16 md:pt-40 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-10 md:gap-16">
            <div class="shrink-0">
                <div class="w-48 h-48 md:w-64 md:h-64 rounded-2xl bg-gradient-to-br from-primary-600 to-primary-400 p-1 shadow-lg">
                    <div class="w-full h-full rounded-xl bg-neutral-200 dark:bg-neutral-700 flex items-center justify-center overflow-hidden">
                        @if ($profile && $profile->photo)
                            <img src="{{ Storage::url($profile->photo) }}" alt="Profile photo" class="w-full h-full object-cover">
                        @else
                            <svg class="w-20 h-20 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex-1 text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold text-neutral-900 dark:text-white text-balance">Tentang Saya</h1>
                <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 leading-relaxed text-balance">
                    @if ($profile)
                        {{ $profile->localize('summary') }}
                    @else
                        Saya adalah System Analyst yang tidak berhenti di dokumen. Setelah bertahun-tahun menganalisis kebutuhan bisnis dan merancang arsitektur sistem, saya mulai "turun ke kode" — langsung mengeksekusi solusi yang saya rancang. Dengan bantuan AI tools, saya bisa bergerak lebih cepat dari analisis ke production tanpa mengorbankan kualitas.
                    @endif
                </p>
                @if ($profile && $profile->cv_id)
                    <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
                        <a href="{{ Storage::url($profile->cv_id) }}" class="inline-flex items-center px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Download CV
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Experience -->
<section class="py-16 md:py-24 bg-neutral-50 dark:bg-neutral-900 border-y border-neutral-200 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10">Pengalaman Kerja</h2>
        <div class="max-w-3xl space-y-6">
            @forelse ($experiences as $experience)
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 flex flex-col sm:flex-row gap-4" data-delay="{{ $loop->iteration }}">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700">
                            @if ($experience->logo)
                                <img src="{{ Storage::url($experience->logo) }}" alt="{{ $experience->company_name }}" class="w-6 h-6 object-contain">
                            @else
                                <svg class="w-6 h-6 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">{{ $experience->position }}</h3>
                        <p class="text-base font-medium text-primary-600">{{ $experience->company_name }}</p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">
                            {{ $experience->started_at->format('M Y') }} — {{ $experience->is_current ? 'Sekarang' : $experience->ended_at->format('M Y') }}
                        </p>
                        <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">{{ $experience->localize('description') }}</p>
                    </div>
                </div>
            @empty
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 flex flex-col sm:flex-row gap-4" data-delay="1">
                    <div class="shrink-0"><div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z"/></svg></div></div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">System Analyst Lead</h3>
                        <p class="text-base font-medium text-primary-600">PT. Digital Nusantara</p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Jan 2022 — Sekarang · 3 tahun</p>
                        <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Memimpin analisis kebutuhan dan perancangan arsitektur aplikasi ERP, lalu langsung mengimplementasikan modul critical seperti inventory dan procurement. Menggunakan AI tools untuk mempercepat scaffolding dan code review. Bertanggung jawab end-to-end dari requirement gathering sampai deployment.</p>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 flex flex-col sm:flex-row gap-4" data-delay="2">
                    <div class="shrink-0"><div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg></div></div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">System Analyst & Backend Developer</h3>
                        <p class="text-base font-medium text-primary-600">Startup Teknologi Sejahtera</p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">Jun 2019 — Des 2021 · 2,5 tahun</p>
                        <p class="text-sm text-neutral-600 dark:text-neutral-300 mt-3 leading-relaxed">Menganalisis alur bisnis fintech, merancang sistem autentikasi dan payment gateway, lalu langsung mengembangkan REST API dengan Laravel. Menyusun dokumentasi teknis dan memastikan alignment antara kebutuhan bisnis dengan implementasi kode.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Workflow Saya -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10">Workflow Saya</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
                <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Discover</h3>
                <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">Wawancara stakeholder, dokumentasi requirement, dan user story mapping.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude</span>
                </div>
            </div>
            <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
                <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0121 18.382V7.618a1 1 0 01-.447-.894L15 7m0 13V7"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Design</h3>
                <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">ERD, flow diagram, arsitektur sistem, dan API contract design.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude</span>
                </div>
            </div>
            <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="3">
                <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Build</h3>
                <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">Development, testing, dan code review dengan bantuan AI-assisted coding.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Claude Code</span>
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Copilot</span>
                </div>
            </div>
            <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
                <div class="w-12 h-12 rounded-lg bg-primary-600/10 flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-2">Deploy</h3>
                <p class="text-sm text-neutral-600 dark:text-neutral-300 leading-relaxed">CI/CD setup, dokumentasi, dan monitoring dengan AI-assisted configuration.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-primary-600/10 text-primary-600 border border-primary-600/20">Cursor</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10">Riwayat Pendidikan</h2>
        <div class="max-w-3xl space-y-6">
            @forelse ($educations as $education)
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 flex flex-col sm:flex-row gap-4" data-delay="{{ $loop->iteration }}">
                    <div class="shrink-0">
                        <div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700">
                            @if ($education->logo)
                                <img src="{{ Storage::url($education->logo) }}" alt="{{ $education->institution_name }}" class="w-6 h-6 object-contain">
                            @else
                                <svg class="w-6 h-6 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">{{ $education->institution_name }}</h3>
                        <p class="text-base font-medium text-neutral-700 dark:text-neutral-200">{{ $education->localize('major') }} — {{ $education->degree }}</p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">{{ $education->started_at->format('Y') }} — {{ $education->ended_at->format('Y') }}</p>
                    </div>
                </div>
            @empty
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 flex flex-col sm:flex-row gap-4" data-delay="1">
                    <div class="shrink-0"><div class="w-12 h-12 rounded-lg bg-neutral-100 dark:bg-neutral-800 flex items-center justify-center border border-neutral-200 dark:border-neutral-700"><svg class="w-6 h-6 text-neutral-400" fill="currentColor" viewBox="0 0 24 24"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg></div></div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-neutral-900 dark:text-white">Universitas Indonesia</h3>
                        <p class="text-base font-medium text-neutral-700 dark:text-neutral-200">Ilmu Komputer — S1</p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400 mt-1">2015 — 2019</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Skills -->
<section class="py-16 md:py-24 bg-neutral-50 dark:bg-neutral-900 border-y border-neutral-200 dark:border-neutral-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-white mb-10">Keahlian</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($skillCategories as $category)
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="{{ $loop->iteration }}">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">{{ $category->localize('name') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($category->skills as $skill)
                            <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">{{ $skill->localize('name') }}</span>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="1">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Analisis & Perancangan</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">System Analysis</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">UML / ERD</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">BPMN</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">User Story</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">API Design</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Database Design</span>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="2">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">Development Stack</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PHP / Laravel</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">JavaScript</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Vue.js</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Tailwind CSS</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">MySQL</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">PostgreSQL</span>
                    </div>
                </div>
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6" data-delay="3">
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-white mb-4">AI Tools & Productivity</h3>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Cursor</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Claude Code</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">GitHub Copilot</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">v0</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">ChatGPT</span>
                        <span class="px-2.5 py-1 rounded-md text-xs font-medium bg-neutral-100 dark:bg-neutral-800 text-neutral-600 dark:text-neutral-300 border border-neutral-200 dark:border-neutral-700">Prompt Engineering</span>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
