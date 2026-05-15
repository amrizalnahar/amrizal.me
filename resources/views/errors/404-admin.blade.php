@extends('layouts.admin')

@section('title', 'Halaman Tidak Ditemukan — Admin')

@section('content')
    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center">
        <div class="text-center px-4">
            <div class="relative mx-auto w-32 h-32 mb-6">
                <div class="absolute inset-0 rounded-full bg-neutral-100"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-16 h-16 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="absolute top-2 right-3 w-2.5 h-2.5 rounded-full bg-neutral-300"></div>
                <div class="absolute bottom-3 left-2 w-2 h-2 rounded-full bg-neutral-300"></div>
            </div>

            <h1 class="text-6xl font-extrabold text-neutral-900 tracking-tight">
                4<span class="text-neutral-400">0</span>4
            </h1>

            <p class="mt-3 text-lg font-semibold text-neutral-800">
                Halaman tidak ditemukan
            </p>
            <p class="mt-1 text-neutral-500 max-w-sm mx-auto">
                Sepertinya halaman yang Anda cari tidak tersedia di panel admin. Periksa kembali URL atau kembali ke dashboard.
            </p>

            <div class="mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md text-sm font-semibold text-white transition-colors" style="background-color: #C3110C;" onmouseover="this.style.backgroundColor='#9A0D09'" onmouseout="this.style.backgroundColor='#C3110C'">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>
                <button onclick="history.back()" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md text-sm font-semibold text-neutral-700 bg-white border border-neutral-200 hover:bg-neutral-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Kembali
                </button>
            </div>
        </div>
    </div>
@endsection
