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
        <h1 class="text-xl font-bold text-neutral-800">Daftar Proyek</h1>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Proyek
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-4 mb-4 flex flex-col lg:flex-row gap-3">
        <div class="flex-1">
            <input wire:model.live="search" type="text" placeholder="Cari judul, perusahaan, atau tipe..."
                   class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
        </div>
        <div class="flex gap-3 flex-col sm:flex-row">
            <select wire:model.live="statusFilter" class="w-full sm:w-40 border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                <option value="">Semua Status</option>
                <option value="draft">Draft</option>
                <option value="publish">Publish</option>
            </select>
            <select wire:model.live="perPage" class="w-full sm:w-28 border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                <option value="10">10 / hal</option>
                <option value="25">25 / hal</option>
                <option value="50">50 / hal</option>
            </select>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-neutral-50 text-neutral-600 font-medium border-b border-neutral-200">
                    <tr>
                        <th class="px-4 py-3 w-16">Thumb</th>
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('title_id')">
                            Judul {!! $sortField === 'title_id' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3">Perusahaan</th>
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('status')">
                            Status {!! $sortField === 'status' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('views')">
                            Views {!! $sortField === 'views' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('sort_order')">
                            Urutan {!! $sortField === 'sort_order' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse ($this->projects as $project)
                        <tr class="hover:bg-neutral-50 transition-colors">
                            <td class="px-4 py-3">
                                @if($project->thumbnail)
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="" class="w-10 h-10 rounded-lg object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-neutral-100 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-neutral-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="font-medium text-neutral-800">{{ Str::limit($project->title_id, 50) }}</div>
                                <div class="mt-0.5">
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-700">{{ $project->type }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-neutral-600">{{ $project->company_name ?: '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $project->status === 'publish' ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-600' }}">
                                    {{ $project->status === 'publish' ? 'Publish' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-neutral-600">{{ number_format($project->views) }}</td>
                            <td class="px-4 py-3 text-neutral-600">{{ $project->sort_order }}</td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="p-1.5 text-neutral-500 hover:text-primary-600 hover:bg-primary-50 rounded-md transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button wire:click="confirmDelete({{ $project->id }})" class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-neutral-500">Tidak ada data proyek.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t border-neutral-200">
            {{ $this->projects->links() }}
        </div>
    </div>

    <!-- Single Delete Confirmation Modal -->
    @if($deleteId)
        <div class="fixed inset-0 z-50 flex items-center justify-center" x-data x-init="">
            <div class="absolute inset-0 bg-black/50" wire:click="$set('deleteId', null); $set('deleteTitle', null)"></div>
            <div class="relative bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
                <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-neutral-600 mb-4">Yakin ingin menghapus proyek "{{ $deleteTitle }}"? Tindakan ini tidak dapat dibatalkan.</p>
                <div class="flex justify-end gap-2">
                    <button wire:click="$set('deleteId', null); $set('deleteTitle', null)" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-xs font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <button wire:click="delete" wire:loading.attr="disabled" class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
                </div>
            </div>
        </div>
    @endif
</div>
