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

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-xl font-bold text-gray-800">Pesan Kontak</h1>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-4 flex flex-col lg:flex-row gap-3">
        <div class="flex-1">
            <input wire:model.live="search" type="text" placeholder="Cari nama, email, atau subjek..."
                   class="w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-lg text-sm">
        </div>
        <div class="flex gap-3 flex-col sm:flex-row">
            <select wire:model.live="statusFilter" class="w-full sm:w-36 border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-lg text-sm">
                <option value="">Semua Status</option>
                <option value="unread">Belum Dibaca</option>
                <option value="read">Sudah Dibaca</option>
            </select>
            <select wire:model.live="perPage" class="w-full sm:w-28 border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-lg text-sm">
                <option value="10">10 / hal</option>
                <option value="25">25 / hal</option>
                <option value="50">50 / hal</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 cursor-pointer hover:text-gray-800" wire:click="sortBy('name')">
                            Nama {!! $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Subjek</th>
                        <th class="px-4 py-3 cursor-pointer hover:text-gray-800" wire:click="sortBy('status')">
                            Status {!! $sortField === 'status' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3 cursor-pointer hover:text-gray-800" wire:click="sortBy('created_at')">
                            Tanggal {!! $sortField === 'created_at' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($this->contacts as $contact)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-medium text-gray-800">
                                {{ $contact->name }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ Str::limit($contact->email, 30) }}
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ Str::limit($contact->subject, 40) }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $contact->status === 'unread' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $contact->status === 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $contact->created_at->translatedFormat('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="p-1.5 text-gray-500 hover:text-[#1A6FAA] hover:bg-blue-50 rounded-md transition-colors" title="Lihat Detail">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    @if($contact->status === 'unread')
                                        <button wire:click="markAsRead({{ $contact->id }})" class="p-1.5 text-gray-500 hover:text-green-600 hover:bg-green-50 rounded-md transition-colors" title="Tandai sudah dibaca">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76"></path></svg>
                                        </button>
                                    @else
                                        <button wire:click="markAsUnread({{ $contact->id }})" class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors" title="Tandai belum dibaca">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </button>
                                    @endif
                                    <button wire:click="confirmDelete({{ $contact->id }})" class="p-1.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-8 text-center text-gray-500">Tidak ada pesan kontak.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t border-gray-200">
            {{ $this->contacts->links() }}
        </div>
    </div>

    <!-- Single Delete Confirmation Modal -->
    @if($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center" x-data x-init="">
            <div class="absolute inset-0 bg-black/50" wire:click="$set('deleteId', null); $set('deleteTitle', null)"></div>
            <div class="relative bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-gray-600 mb-4">Yakin ingin menghapus pesan dari "{{ $deleteTitle }}"? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-2">
                    <button wire:click="$set('deleteId', null); $set('deleteTitle', null)" class="px-4 py-2 bg-gray-100 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</button>
                    <button wire:click="delete" wire:loading.attr="disabled" class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
                </div>
            </div>
        </div>
    @endif
</div>
