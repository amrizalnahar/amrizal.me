@props(['active' => 'home'])

<!-- Mobile Backdrop -->
<div id="mobile-backdrop" class="fixed inset-0 z-40 bg-black/40 backdrop-blur-sm hidden transition-opacity duration-300 opacity-0"></div>

<!-- Mobile Drawer -->
<div id="mobile-drawer" class="fixed top-0 right-0 bottom-0 z-50 w-72 max-w-full bg-white dark:bg-neutral-900 shadow-2xl transform translate-x-full transition-transform duration-300 ease-out flex flex-col">
  <div class="flex items-center justify-between h-16 px-4 sm:px-6 border-b border-neutral-200 dark:border-neutral-800 shrink-0">
    <span class="text-lg font-bold tracking-tight text-neutral-900 dark:text-white">Menu</span>
    <button id="mobile-close-btn" class="w-9 h-9 flex items-center justify-center rounded-full text-neutral-600 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition-colors" aria-label="Tutup menu">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
  </div>
  <div class="flex-1 overflow-y-auto p-4 sm:px-6">
    <div class="flex flex-col gap-1">
      <a href="/" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'home' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}">Beranda</a>
      <a href="/about" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'about' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}">Tentang Saya</a>
      <a href="/portfolio" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'portfolio' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}">Portofolio</a>
      <a href="/blog" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'blog' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}">Blog</a>
      <a href="/contact" class="px-3 py-2 rounded-md text-sm font-medium {{ $active === 'contact' ? 'text-primary-600 bg-primary-600/5' : 'text-neutral-600 dark:text-neutral-300 hover:text-primary-600 hover:bg-primary-600/5 transition-colors' }}">Kontak</a>
    </div>
  </div>
</div>
