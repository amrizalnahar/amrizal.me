@extends('layouts.public')

@section('title', 'Halaman Tidak Ditemukan — ' . config('app.name'))
@section('description', 'Halaman yang Anda cari tidak ditemukan. Kembali ke beranda amrizal.site.')

@section('content')
<div class="min-h-screen flex items-center justify-center pt-16 my-16 bg-neutral-50 dark:bg-neutral-950">
  <div class="max-w-lg mx-auto px-4 sm:px-6 text-center">
    <!-- Illustration -->
    <div class="relative mx-auto w-40 h-40 sm:w-48 sm:h-48 mb-8">
      <div class="absolute inset-0 rounded-full bg-gradient-to-br from-primary-600/10 to-primary-400/10 dark:from-primary-600/5 dark:to-primary-400/5"></div>
      <div class="absolute inset-0 flex items-center justify-center">
        <svg class="w-20 h-20 sm:w-24 sm:h-24 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
      </div>
      <!-- Decorative dots -->
      <div class="absolute top-2 right-4 w-3 h-3 rounded-full bg-primary-400/40 dark:bg-primary-400/20"></div>
      <div class="absolute bottom-4 left-2 w-2 h-2 rounded-full bg-primary-600/30 dark:bg-primary-600/15"></div>
      <div class="absolute top-1/2 -right-2 w-2 h-2 rounded-full bg-primary-400/20 dark:bg-primary-400/10"></div>
    </div>

    <!-- Error Code -->
    <h1 class="text-7xl sm:text-8xl font-extrabold text-neutral-900 dark:text-white tracking-tight">
      4<span class="text-primary-600">0</span>4
    </h1>

    <!-- Message -->
    <p class="mt-4 text-xl font-semibold text-neutral-900 dark:text-white">
      Halaman tidak ditemukan
    </p>
    <p class="mt-2 text-neutral-600 dark:text-neutral-400 text-balance">
      Sepertinya halaman yang Anda cari telah dipindahkan, dihapus, atau tidak pernah ada. Jangan khawatir, mari kembali ke jalur yang benar.
    </p>

    <!-- Actions -->
    <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-3">
      <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
        Kembali ke Beranda
      </a>
      <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold text-neutral-700 dark:text-neutral-200 bg-neutral-100 dark:bg-neutral-800 border border-neutral-200 dark:border-neutral-700 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        Hubungi Saya
      </a>
    </div>

    <!-- Quick Links -->
    <div class="mt-10 pt-8 border-t border-neutral-200 dark:border-neutral-800">
      <p class="text-sm text-neutral-500 dark:text-neutral-400 mb-4">Atau kunjungi halaman populer:</p>
      <div class="flex flex-wrap items-center justify-center gap-2">
        <a href="{{ route('portfolio.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 hover:border-primary-600/30 hover:text-primary-600 transition-colors">
          Portofolio
        </a>
        <a href="{{ route('blog.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 hover:border-primary-600/30 hover:text-primary-600 transition-colors">
          Blog
        </a>
        <a href="{{ route('about') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 hover:border-primary-600/30 hover:text-primary-600 transition-colors">
          Tentang Saya
        </a>
        <a href="{{ route('contact') }}" class="px-4 py-2 rounded-lg text-sm font-medium bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-neutral-700 dark:text-neutral-300 hover:border-primary-600/30 hover:text-primary-600 transition-colors">
          Kontak
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
