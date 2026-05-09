<div>
    <!-- Toast -->
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show" x-transition
         class="fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm font-medium"
         :class="type === 'success' ? 'bg-green-600' : 'bg-red-600'"
         style="display: none;">
        <span x-text="message"></span>
    </div>

    <div class="max-w-3xl mx-auto">
        <!-- Back Link -->
        <a href="{{ route('admin.contacts') }}" class="inline-flex items-center text-sm text-neutral-500 hover:text-primary-600 mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Pesan
        </a>

        <h1 class="text-xl font-bold text-neutral-800 mb-6">Detail Pesan</h1>

        <!-- Message Card -->
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
            <div class="p-6 space-y-4">
                <!-- From -->
                <div>
                    <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Dari</div>
                    <div class="text-neutral-800 font-medium">{{ $contact->name }}</div>
                    <div class="text-sm text-neutral-500">{{ $contact->email }}</div>
                </div>

                <!-- Subject -->
                <div>
                    <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Subjek</div>
                    <div class="text-neutral-800">{{ $contact->subject }}</div>
                </div>

                <!-- Meta -->
                <div class="flex flex-wrap gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Tanggal</div>
                        <div class="text-sm text-neutral-600">{{ $contact->created_at->translatedFormat('d M Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">IP Address</div>
                        <div class="text-sm text-neutral-600">{{ $contact->ip_address ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Status</div>
                        <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $contact->status === 'unread' ? 'bg-primary-100 text-primary-700' : 'bg-neutral-100 text-neutral-600' }}">
                            {{ $contact->status === 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca' }}
                        </span>
                    </div>
                </div>

                <!-- User Agent -->
                @if($contact->user_agent)
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">User Agent</div>
                        <div class="text-xs text-neutral-400">{{ Str::limit($contact->user_agent, 120) }}</div>
                    </div>
                @endif

                <!-- Message Body -->
                <div>
                    <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-2">Pesan</div>
                    <div class="bg-neutral-50 p-4 rounded-lg text-neutral-700 text-sm whitespace-pre-wrap">{{ $contact->message }}</div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-200 flex flex-wrap gap-3">
                <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Balas via Email
                </a>

                @if($contact->status === 'read')
                    <button wire:click="markAsUnread" class="inline-flex items-center px-4 py-2 bg-white border border-neutral-300 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Tandai Belum Dibaca
                    </button>
                @endif

                <button
                    x-data
                    @click="if (confirm('Yakin ingin menghapus pesan ini?')) { $wire.delete() }"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    Hapus Pesan
                </button>
            </div>
        </div>
    </div>
</div>
