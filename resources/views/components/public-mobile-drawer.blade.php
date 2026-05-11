@props(['active' => 'home'])

<!-- Mobile Backdrop -->
<div id="mobile-backdrop" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm hidden transition-opacity duration-300 opacity-0"></div>

<!-- Mobile Drawer -->
<div id="mobile-drawer" class="fixed top-0 right-0 bottom-0 z-50 w-72 max-w-full bg-white dark:bg-neutral-900 shadow-2xl transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
  <div class="flex items-center justify-between h-16 px-4 sm:px-6 border-b border-neutral-200 dark:border-neutral-800 shrink-0">
    <span class="text-lg font-bold tracking-tight text-neutral-900 dark:text-white" data-i18n="menu">{{ __('public.menu') }}</span>
    <button id="mobile-close-btn" class="w-9 h-9 flex items-center justify-center rounded-full text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="{{ __('public.close_menu') }}" data-i18n-attr="aria-label:close_menu">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
  </div>
  <div class="flex-1 overflow-y-auto p-4 sm:px-6">
    <div class="flex flex-col gap-1">
      <a href="/" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'home' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.home">{{ __('public.nav.home') }}</a>
      <a href="/about" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'about' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.about">{{ __('public.nav.about') }}</a>
      <a href="/portfolio" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'portfolio' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.portfolio">{{ __('public.nav.portfolio') }}</a>
      <a href="/blog" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'blog' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.blog">{{ __('public.nav.blog') }}</a>
      <a href="/contact" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'contact' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}" data-i18n="nav.contact">{{ __('public.nav.contact') }}</a>
    </div>
    <div class="mt-6 pt-4 border-t border-neutral-200 dark:border-neutral-800">
      <div class="flex items-center gap-2">
        <span class="text-xs text-neutral-500 dark:text-neutral-400" data-i18n="language">{{ __('public.language') }}:</span>
        <div class="flex items-center bg-neutral-100 dark:bg-neutral-800 rounded-full p-0.5" x-data="{}">
          <button @click="$store.i18n.setLocale('id')" :class="$store.i18n.locale === 'id' ? 'bg-primary-600 text-white' : 'text-neutral-500 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors'" class="px-2.5 py-1 rounded-full text-xs font-medium">ID</button>
          <button @click="$store.i18n.setLocale('en')" :class="$store.i18n.locale === 'en' ? 'bg-primary-600 text-white' : 'text-neutral-500 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-white transition-colors'" class="px-2.5 py-1 rounded-full text-xs font-medium">EN</button>
        </div>
      </div>
    </div>
  </div>
</div>
