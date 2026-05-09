<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.projects') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">{{ $project ? 'Edit Proyek' : 'Tambah Proyek' }}</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Section 1: Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Informasi Dasar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="title_id" value="Judul (ID)" />
                        <div class="relative mt-1">
                            <x-text-input id="title_id" wire:model="title_id" type="text" class="block w-full pr-12" placeholder="Masukkan judul proyek" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">ID</span>
                        </div>
                        <x-input-error :messages="$errors->get('title_id')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="title_en" value="Judul (EN)" />
                        <div class="relative mt-1">
                            <x-text-input id="title_en" wire:model="title_en" type="text" class="block w-full pr-12" placeholder="Project title" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400 font-medium">EN</span>
                        </div>
                        <x-input-error :messages="$errors->get('title_en')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="type" value="Tipe Proyek" />
                        <x-text-input id="type" wire:model="type" type="text" class="mt-1 block w-full" placeholder="Contoh: Website, Mobile App, Sistem Informasi" />
                        <x-input-error :messages="$errors->get('type')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="company_name" value="Nama Perusahaan" />
                        <x-text-input id="company_name" wire:model="company_name" type="text" class="mt-1 block w-full" placeholder="Nama perusahaan / klien" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="sort_order" value="Urutan" />
                        <x-text-input id="sort_order" wire:model="sort_order" type="number" min="0" class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Deskripsi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Deskripsi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="short_description_id" value="Deskripsi Singkat (ID)" />
                        <div class="relative mt-1">
                            <textarea id="short_description_id" wire:model="short_description_id" rows="3" class="block w-full pr-12 border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Deskripsi singkat proyek"></textarea>
                            <span class="absolute right-3 top-3 text-xs text-gray-400 font-medium">ID</span>
                        </div>
                        <x-input-error :messages="$errors->get('short_description_id')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="short_description_en" value="Deskripsi Singkat (EN)" />
                        <div class="relative mt-1">
                            <textarea id="short_description_en" wire:model="short_description_en" rows="3" class="block w-full pr-12 border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Short project description"></textarea>
                            <span class="absolute right-3 top-3 text-xs text-gray-400 font-medium">EN</span>
                        </div>
                        <x-input-error :messages="$errors->get('short_description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 3: Detail Lengkap -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Detail Lengkap</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label value="Detail Lengkap (ID)" />
                        <div class="mt-1" wire:ignore>
                            <trix-editor
                                x-data
                                x-on:trix-change="$wire.set('full_description_id', $event.target.value)"
                                x-ref="trix-id"
                                input="trix-full-desc-id"
                                class="trix-content border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm min-h-[200px]"
                            >{!! $full_description_id !!}</trix-editor>
                        </div>
                        <input type="hidden" id="trix-full-desc-id" value="{{ $full_description_id }}">
                        <x-input-error :messages="$errors->get('full_description_id')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label value="Detail Lengkap (EN)" />
                        <div class="mt-1" wire:ignore>
                            <trix-editor
                                x-data
                                x-on:trix-change="$wire.set('full_description_en', $event.target.value)"
                                x-ref="trix-en"
                                input="trix-full-desc-en"
                                class="trix-content border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm min-h-[200px]"
                            >{!! $full_description_en !!}</trix-editor>
                        </div>
                        <input type="hidden" id="trix-full-desc-en" value="{{ $full_description_en }}">
                        <x-input-error :messages="$errors->get('full_description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 4: Thumbnail -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Thumbnail" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($thumbnail)
                        <div class="relative">
                            <img src="{{ $thumbnail->temporaryUrl() }}" class="w-32 h-24 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('thumbnail', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingThumbnail)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingThumbnail) }}" class="w-32 h-24 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('existingThumbnail', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="thumbnail"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-1" />
                        <div wire:loading wire:target="thumbnail" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Tautan -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Tautan</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="demo_url" value="URL Demo" />
                        <x-text-input id="demo_url" wire:model="demo_url" type="text" class="mt-1 block w-full" placeholder="https://..." />
                        <x-input-error :messages="$errors->get('demo_url')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="repo_url" value="URL Repository" />
                        <x-text-input id="repo_url" wire:model="repo_url" type="text" class="mt-1 block w-full" placeholder="https://github.com/..." />
                        <x-input-error :messages="$errors->get('repo_url')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 6: Tim & Peran -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-semibold text-gray-700 mb-4">Tim &amp; Peran</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="role" value="Peran" />
                        <x-text-input id="role" wire:model="role" type="text" class="mt-1 block w-full" placeholder="Contoh: Lead Developer, System Analyst" />
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="period" value="Periode" />
                        <x-text-input id="period" wire:model="period" type="text" class="mt-1 block w-full" placeholder="Jan 2023 — Des 2023" />
                        <x-input-error :messages="$errors->get('period')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 7: Teknologi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Teknologi" class="mb-2" />
                <div class="flex gap-2 mb-3">
                    <x-text-input wire:model="newTechnology" type="text" placeholder="Tambah teknologi..." class="block w-full text-sm" x-on:keydown.enter.prevent="$wire.addTechnology()" />
                    <button type="button" wire:click="addTechnology" class="px-3 py-2 bg-[#1A6FAA] text-white text-sm rounded-md hover:bg-[#155a8a] transition-colors shrink-0">Tambah</button>
                </div>
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach($technologies as $index => $tech)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-[#1A6FAA]/10 text-[#1A6FAA] text-sm font-medium">
                            {{ $tech }}
                            <button type="button" wire:click="removeTechnology({{ $index }})" class="ml-1.5 hover:text-red-600">&times;</button>
                        </span>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('newTechnology')" class="mt-1" />
            </div>

            <!-- Section 8: Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Status" class="mb-3" />
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" value="draft" class="border-gray-300 text-[#1A6FAA] focus:ring-[#1A6FAA]">
                        <span class="ml-2 text-sm text-gray-700">Draft</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" value="publish" class="border-gray-300 text-[#1A6FAA] focus:ring-[#1A6FAA]">
                        <span class="ml-2 text-sm text-gray-700">Publish</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('status')" class="mt-1" />
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.projects') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                <x-primary-button type="submit">{{ $project ? 'Simpan Perubahan' : 'Tambah Proyek' }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
