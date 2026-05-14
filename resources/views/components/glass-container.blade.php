{{-- resources/views/components/glass-container.blade.php --}}
<div {{ $attributes->merge(['class' => 'glass']) }}>
    {{ $slot }}
</div>
