@props(['title', 'size' => 'md'])

@php
$initial = strtoupper(mb_substr($title, 0, 1));
$sizes = [
    'sm' => 'text-3xl',
    'md' => 'text-5xl',
    'lg' => 'text-7xl',
];
$textSize = $sizes[$size] ?? $sizes['md'];
@endphp

<div class="w-full h-full bg-gradient-to-br from-primary-600/10 via-primary-400/5 to-transparent dark:from-primary-600/15 dark:via-primary-400/10 dark:to-transparent flex items-center justify-center">
    <span class="{{ $textSize }} font-display font-bold text-primary-600/25 dark:text-primary-400/20 select-none">
        {{ $initial }}
    </span>
</div>
