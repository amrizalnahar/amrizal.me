<div>
    <!-- Toast Notification -->
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show"
         x-transition
         class="fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm font-medium"
         :class="type === 'success' ? 'bg-green-600' : 'bg-red-600'"
         style="display: none;"
    >
        <span x-text="message"></span>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-xl font-bold text-neutral-800">Manajemen Tag</h1>
        @can('tags-create')
        <button wire:click="openModal" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Tag
        </button>
        @endcan
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-4 mb-4 flex flex-col sm:flex-row gap-3">
        <div class="flex-1">
            <input wire:model.live="search" type="text" placeholder="Cari nama tag..."
                   class="w-full sm:w-80 border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
        </div>
        <div class="sm:w-32">
            <select wire:model.live="perPage"
                    class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                <option value="10">10 / hal</option>
                <option value="25">25 / hal</option>
                <option value="50">50 / hal</option>
            </select>
        </div>
    </div>

    <!-- Bulk Actions -->
    @if(count($selected) > 0)
        <div class="bg-primary-50 border border-primary-200 rounded-lg p-3 mb-4 flex items-center justify-between" x-data="{ showDeleteModal: false }">
            <span class="text-sm text-primary-800">{{ count($selected) }} item dipilih</span>
            <div class="flex gap-2">
                @can('tags-delete')
                <button @click="showDeleteModal = true" class="px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded-md hover:bg-red-700 transition-colors">Hapus</button>
                @endcan
            </div>

            <!-- Delete Confirmation Modal -->
            <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
                <div class="absolute inset-0 bg-black/50" @click="showDeleteModal = false"></div>
                <div class="relative bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
                    <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                    <p class="text-sm text-neutral-600 mb-4">Yakin ingin menghapus {{ count($selected) }} tag yang dipilih? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="flex justify-end gap-2">
                        <button @click="showDeleteModal = false" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-xs font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                        <button wire:click="bulkDelete" @click="showDeleteModal = false" class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-neutral-50 text-neutral-600 font-medium border-b border-neutral-200">
                    <tr>
                        <th class="px-5 py-3 w-10">
                            @php
                                $pageIds = $tags->pluck('id')->map(fn($id) => (string) $id)->toArray();
                                $allPageSelected = count($pageIds) > 0 && count(array_diff($pageIds, $selected)) === 0;
                            @endphp
                            <input type="checkbox" wire:click.prevent="toggleSelectPage" @checked($allPageSelected) wire:key="select-all-page-{{ $tags->currentPage() }}" class="rounded border-neutral-300 text-primary-600 focus:ring-primary-600">
                        </th>
                        <th class="px-5 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('name')">
                            Nama {!! $sortField === 'name' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-5 py-3 cursor-pointer hover:text-neutral-800" wire:click="sortBy('slug')">
                            Slug {!! $sortField === 'slug' ? ($sortDirection === 'asc' ? '↑' : '↓') : '' !!}
                        </th>
                        <th class="px-5 py-3 text-center">Jumlah Konten Terkait</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse ($tags as $tag)
                        <tr class="hover:bg-neutral-50 transition-colors" wire:key="row-{{ $tag->id }}">
                            <td class="px-5 py-3.5">
                                <input type="checkbox" wire:model.live="selected" value="{{ $tag->id }}" class="rounded border-neutral-300 text-primary-600 focus:ring-primary-600">
                            </td>
                            <td class="px-5 py-3.5 font-medium text-neutral-800">{{ $tag->name }}</td>
                            <td class="px-5 py-3.5 text-neutral-500">{{ $tag->slug }}</td>
                            <td class="px-5 py-3.5 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-neutral-100 text-xs font-semibold text-neutral-700">
                                    {{ $tag->total_content }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('tags-edit')
                                    <button wire:click="edit({{ $tag->id }})" class="p-1.5 text-neutral-500 hover:text-primary-600 hover:bg-primary-50 rounded-md transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    @endcan
                                    @can('tags-delete')
                                    <button wire:click="confirmDelete({{ $tag->id }})" class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-neutral-500">Tidak ada data tag.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-5 py-3 border-t border-neutral-200">
            {{ $tags->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    <x-modal name="tag-modal" :show="false">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">{{ $editingId ? 'Edit Tag' : 'Tambah Tag' }}</h3>

            <form wire:submit="save">
                <div class="space-y-4">
                    <div>
                        <x-input-label for="tag_name" value="Nama Tag" />
                        <x-text-input id="tag_name" wire:model="name" type="text" class="mt-1 block w-full" placeholder="Masukkan nama tag" />
                        <x-input-error :messages="$errors->get('name')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="tag_slug" value="Slug" />
                        <div class="flex gap-2 mt-1">
                            <x-text-input id="tag_slug" wire:model="slug" type="text" class="block w-full" placeholder="auto-generated" />
                            <button type="button" wire:click="generateSlug" class="px-3 py-2 bg-neutral-100 text-neutral-600 text-sm rounded-md hover:bg-neutral-200 transition-colors">Generate</button>
                        </div>
                        <x-input-error :messages="$errors->get('slug')" class="mt-1" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-primary-button type="submit">{{ $editingId ? 'Simpan Perubahan' : 'Tambah Tag' }}</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Delete Confirmation Modal -->
    @if($confirmingDelete)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50" wire:click="cancelDelete"></div>
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 z-10 p-6">
                <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-neutral-500 mb-6">Apakah Anda yakin ingin menghapus tag ini? Data akan dipindahkan ke tong sampah.</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-danger-button wire:click="delete">Hapus</x-danger-button>
                </div>
            </div>
        </div>
    @endif

</div>
