<div>
    <!-- Shortcut Buttons -->
    <div class="flex flex-wrap gap-3 mb-6">
        @can('posts-create')
        <a href="{{ route('admin.blog.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
            <x-icon name="plus" class="w-4 h-4 mr-2" />
            Tulis Berita
        </a>
        @endcan
    </div>

    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-neutral-500">Berita Published</div>
                    <div class="text-3xl font-bold text-neutral-800 mt-1">{{ $stats['posts'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-primary-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-neutral-500">Proyek</div>
                    <div class="text-3xl font-bold text-neutral-800 mt-1">{{ $stats['projects'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-neutral-500">Sertifikat</div>
                    <div class="text-3xl font-bold text-neutral-800 mt-1">{{ $stats['certificates'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-amber-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-neutral-500">Pesan Belum Dibaca</div>
                    <div class="text-3xl font-bold text-neutral-800 mt-1">{{ $stats['unreadContacts'] }}</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-rose-50 flex items-center justify-center">
                    <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aktivitas Terakhir -->
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200">
            <div class="px-5 py-4 border-b border-neutral-100">
                <h3 class="font-semibold text-neutral-800">Aktivitas Terakhir</h3>
            </div>
            <div class="divide-y divide-neutral-100">
                @forelse ($latestActivities as $activity)
                    <div class="px-5 py-4 flex items-start gap-3">
                        <div class="w-8 h-8 rounded-full bg-neutral-100 flex items-center justify-center shrink-0 mt-0.5">
                            <span class="text-xs font-semibold text-neutral-600">{{ strtoupper(substr($activity->user?->name ?? 'S', 0, 1)) }}</span>
                        </div>
                        <div class="min-w-0 flex-1">
                            <div class="text-sm text-neutral-800">
                                <span class="font-medium">{{ $activity->user?->name ?? 'Sistem' }}</span>
                                <span class="text-neutral-500">
                                    @switch($activity->event)
                                        @case('create') membuat @break
                                        @case('update') memperbarui @break
                                        @case('delete') menghapus @break
                                        @default {{ $activity->event }} @break
                                    @endswitch
                                </span>
                                <span class="font-medium">{{ class_basename($activity->auditable_type) }}</span>
                            </div>
                            <div class="text-xs text-neutral-400 mt-0.5">{{ $activity->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @empty
                    <div class="px-5 py-8 text-center text-sm text-neutral-500">Belum ada aktivitas tercatat.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
