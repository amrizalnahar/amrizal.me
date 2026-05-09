{{-- Global UI elements that appear on every page --}}

<!-- Noise Texture -->
<div class="noise-overlay" aria-hidden="true"></div>

<!-- Scroll Progress -->
<div class="scroll-progress" id="scroll-progress" aria-hidden="true"></div>

<!-- Page Transition -->
<div class="page-transition active" id="page-transition" aria-hidden="true"></div>

<!-- Custom Cursor -->
<div class="custom-cursor cursor-dot" id="cursor-dot" aria-hidden="true"></div>
<div class="custom-cursor cursor-ring" id="cursor-ring" aria-hidden="true"></div>

<!-- Back to Top -->
<button id="back-to-top" class="back-to-top" aria-label="Kembali ke atas">
  <svg class="back-to-top-ring" viewBox="0 0 36 36">
    <circle class="back-to-top-track" cx="18" cy="18" r="16" fill="none" stroke="currentColor" stroke-width="2" opacity="0.2"/>
    <circle class="back-to-top-progress" cx="18" cy="18" r="16" fill="none" stroke="currentColor" stroke-width="2" stroke-dasharray="100.53" stroke-dashoffset="100.53" stroke-linecap="round" transform="rotate(-90 18 18)"/>
  </svg>
  <svg class="w-4 h-4 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
</button>
