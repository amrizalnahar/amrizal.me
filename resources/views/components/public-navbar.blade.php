@props(['active' => 'home'])

<nav class="fixed top-0 left-0 right-0 z-40 bg-white/80 dark:bg-neutral-950/80 backdrop-blur-md border-b border-neutral-200 dark:border-neutral-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <a href="/" class="text-xl font-bold tracking-tight text-neutral-900 dark:text-white">
        amrizal<span class="text-primary-600">.</span>me
      </a>
      <div class="hidden md:flex items-center gap-1">
        <a href="/" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'home' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.home">{{ __('public.nav.home') }}</a>
        <a href="/about" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'about' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.about">{{ __('public.nav.about') }}</a>
        <a href="/portfolio" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'portfolio' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.portfolio">{{ __('public.nav.portfolio') }}</a>
        <a href="/blog" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'blog' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.blog">{{ __('public.nav.blog') }}</a>
        <a href="/contact" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'contact' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.contact">{{ __('public.nav.contact') }}</a>
      </div>
      <div class="flex items-center gap-2">
        <div class="flex items-center bg-neutral-100 dark:bg-neutral-800 rounded-full p-0.5" x-data="{}">
          <button @click="$store.i18n.setLocale('id')" :class="$store.i18n.locale === 'id' ? 'bg-primary-600 text-white' : 'text-neutral-500 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors'" class="px-2.5 py-1 rounded-full text-xs font-medium">ID</button>
          <button @click="$store.i18n.setLocale('en')" :class="$store.i18n.locale === 'en' ? 'bg-primary-600 text-white' : 'text-neutral-500 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors'" class="px-2.5 py-1 rounded-full text-xs font-medium">EN</button>
        </div>
        <button id="theme-toggle" class="w-9 h-9 flex items-center justify-center rounded-full text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="Toggle theme">
          <svg class="hidden dark:block w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
          <svg class="block dark:hidden w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
        </button>
        <button id="mobile-menu-btn" class="md:hidden w-9 h-9 flex items-center justify-center rounded-full text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="{{ __('public.menu') }}" data-i18n-attr="aria-label:menu">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
      </div>
    </div>
  </div>
</nav>
