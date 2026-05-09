@extends('layouts.public')

@section('title', __('public.contact.page_title') . ' — ' . config('app.name'))
@section('description', 'Hubungi Amrizal — System Analyst & Builder. Tersedia untuk diskusi, kolaborasi, atau sekadar bertanya.')

@section('content')

<!-- Hero -->
<section class="pt-32 pb-12 md:pt-40 md:pb-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl">
            <p class="text-sm font-medium text-primary-600 mb-3 tracking-wide uppercase">{{ __('public.contact.page_title') }}</p>
            <h1 class="text-3xl md:text-5xl font-extrabold text-neutral-900 dark:text-white leading-tight text-balance">
                {{ __('public.contact.hero_title') }}
            </h1>
            <p class="mt-4 text-lg text-neutral-600 dark:text-neutral-300 text-balance">
                {{ __('public.contact.hero_desc') }}
            </p>
        </div>
    </div>
</section>

<!-- Contact Content -->
<section class="pb-16 md:pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10 lg:gap-16">
            <!-- Contact Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card-animate" data-delay="1">
                    <h2 class="text-xl font-semibold text-neutral-900 dark:text-white mb-4">{{ __('public.contact.contact_info_title') }}</h2>
                    <div class="space-y-4">
                        @if ($settings['email'])
                            <a href="mailto:{{ $settings['email'] }}" class="flex items-start gap-4 p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-primary-600/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ __('public.contact.email') }}</p>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300 group-hover:text-primary-600 transition-colors">{{ $settings['email'] }}</p>
                                </div>
                            </a>
                        @endif
                        @if ($settings['whatsapp'])
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp']) }}" target="_blank" rel="noopener noreferrer" class="flex items-start gap-4 p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-primary-600/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ __('public.contact.whatsapp') }}</p>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300 group-hover:text-primary-600 transition-colors">{{ $settings['whatsapp'] }}</p>
                                </div>
                            </a>
                        @endif
                        @if ($settings['github'])
                            <a href="https://github.com/{{ $settings['github'] }}" target="_blank" rel="noopener noreferrer" class="flex items-start gap-4 p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-primary-600/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ __('public.contact.github') }}</p>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300 group-hover:text-primary-600 transition-colors">github.com/{{ $settings['github'] }}</p>
                                </div>
                            </a>
                        @endif
                        @if ($settings['linkedin'])
                            <a href="https://linkedin.com/in/{{ $settings['linkedin'] }}" target="_blank" rel="noopener noreferrer" class="flex items-start gap-4 p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900 hover:border-primary-600/30 hover:bg-primary-600/5 transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-primary-600/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ __('public.contact.linkedin') }}</p>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300 group-hover:text-primary-600 transition-colors">linkedin.com/in/{{ $settings['linkedin'] }}</p>
                                </div>
                            </a>
                        @endif
                        @if ($settings['location'])
                            <div class="flex items-start gap-4 p-4 rounded-lg border border-neutral-200 dark:border-neutral-800 bg-neutral-50 dark:bg-neutral-900">
                                <div class="w-10 h-10 rounded-lg bg-primary-600/10 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-neutral-900 dark:text-white">{{ __('public.contact.location') }}</p>
                                    <p class="text-sm text-neutral-600 dark:text-neutral-300">{{ $settings['location'] }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-3">
                <div class="card-animate bg-white dark:bg-neutral-900 rounded-xl border border-neutral-200 dark:border-neutral-800 p-6 md:p-8" data-delay="2">
                    <h2 class="text-xl font-semibold text-neutral-900 dark:text-white mb-6">{{ __('public.contact.form_title') }}</h2>

                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Honeypot -->
                        <input type="text" name="website" tabindex="-1" autocomplete="off" style="position:absolute;opacity:0;" value="{{ old('website') }}">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label for="name" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">{{ __('public.contact.name') }}</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border @error('name') border-red-500 dark:border-red-500 @else border-neutral-200 dark:border-neutral-700 @enderror text-neutral-900 dark:text-white placeholder:text-neutral-500 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all" placeholder="{{ __('public.contact.name_placeholder') }}">
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">{{ __('public.contact.email_label') }}</label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border @error('email') border-red-500 dark:border-red-500 @else border-neutral-200 dark:border-neutral-700 @enderror text-neutral-900 dark:text-white placeholder:text-neutral-500 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all" placeholder="{{ __('public.contact.email_placeholder') }}">
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">{{ __('public.contact.subject') }}</label>
                            <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required class="w-full px-4 py-2.5 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border @error('subject') border-red-500 dark:border-red-500 @else border-neutral-200 dark:border-neutral-700 @enderror text-neutral-900 dark:text-white placeholder:text-neutral-500 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all" placeholder="{{ __('public.contact.subject_placeholder') }}">
                            @error('subject')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">{{ __('public.contact.message') }}</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-4 py-2.5 rounded-md text-sm bg-neutral-100 dark:bg-neutral-800 border @error('message') border-red-500 dark:border-red-500 @else border-neutral-200 dark:border-neutral-700 @enderror text-neutral-900 dark:text-white placeholder:text-neutral-500 focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20 outline-none transition-all resize-none" placeholder="{{ __('public.contact.message_placeholder') }}">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <p class="text-xs text-neutral-500 dark:text-neutral-400">{{ __('public.contact.reply_time') }}</p>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 rounded-md text-sm font-semibold text-white bg-primary-600 hover:bg-primary-900 shadow-sm hover:shadow-md transition-all">
                                {{ __('public.contact.send') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
