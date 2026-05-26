<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.projects') }}" class="text-neutral-500 hover:text-neutral-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-neutral-800">{{ $project ? 'Edit Proyek' : 'Tambah Proyek' }}</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Section 1: Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <h2 class="text-sm font-semibold text-neutral-700 mb-4">Informasi Dasar</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="title_id" value="Judul (ID)" />
                        <div class="relative mt-1">
                            <x-text-input id="title_id" wire:model="title_id" type="text" class="block w-full pr-12" placeholder="Masukkan judul proyek" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-neutral-400 font-medium">ID</span>
                        </div>
                        <x-input-error :messages="$errors->get('title_id')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="title_en" value="Judul (EN)" />
                        <div class="relative mt-1">
                            <x-text-input id="title_en" wire:model="title_en" type="text" class="block w-full pr-12" placeholder="Project title" />
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-neutral-400 font-medium">EN</span>
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
                    <div>
                        <x-input-label for="period" value="Periode" />
                        <x-text-input id="period" wire:model="period" type="text" class="mt-1 block w-full" placeholder="Jan 2023 — Des 2023" />
                        <x-input-error :messages="$errors->get('period')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="role" value="Peran / Role" />
                        <x-text-input id="role" wire:model="role" type="text" class="mt-1 block w-full" placeholder="Contoh: Lead System Analyst" />
                        <x-input-error :messages="$errors->get('role')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Deskripsi -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <h2 class="text-sm font-semibold text-neutral-700 mb-4">Deskripsi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="short_description_id" value="Deskripsi Singkat (ID)" />
                        <div class="relative mt-1">
                            <textarea id="short_description_id" wire:model="short_description_id" rows="3" class="block w-full pr-12 border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Deskripsi singkat proyek"></textarea>
                            <span class="absolute right-3 top-3 text-xs text-neutral-400 font-medium">ID</span>
                        </div>
                        <x-input-error :messages="$errors->get('short_description_id')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="short_description_en" value="Deskripsi Singkat (EN)" />
                        <div class="relative mt-1">
                            <textarea id="short_description_en" wire:model="short_description_en" rows="3" class="block w-full pr-12 border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Short project description"></textarea>
                            <span class="absolute right-3 top-3 text-xs text-neutral-400 font-medium">EN</span>
                        </div>
                        <x-input-error :messages="$errors->get('short_description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 3: Detail Lengkap -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <h2 class="text-sm font-semibold text-neutral-700 mb-4">Detail Lengkap</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label value="Detail Lengkap (ID)" />
                        <div class="mt-1" wire:ignore>
                            <trix-editor
                                x-data
                                x-on:trix-change="$wire.set('full_description_id', $event.target.value)"
                                x-ref="trix-id"
                                input="trix-full-desc-id"
                                class="trix-content border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm min-h-[200px]"
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
                                class="trix-content border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm min-h-[200px]"
                            >{!! $full_description_en !!}</trix-editor>
                        </div>
                        <input type="hidden" id="trix-full-desc-en" value="{{ $full_description_en }}">
                        <x-input-error :messages="$errors->get('full_description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 4: Thumbnail -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <x-input-label value="Thumbnail" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($thumbnail)
                        <div class="relative">
                            <img src="{{ $thumbnail->temporaryUrl() }}" class="w-32 h-24 rounded-lg object-cover border border-neutral-200">
                            <button type="button" wire:click="$set('thumbnail', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingThumbnail)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingThumbnail) }}" class="w-32 h-24 rounded-lg object-cover border border-neutral-200">
                            <button type="button" wire:click="$set('existingThumbnail', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="thumbnail"
                               class="block w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-900">
                        <p class="mt-1 text-xs text-neutral-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-1" />
                        <div wire:loading.class.remove="hidden" wire:target="thumbnail" class="hidden mt-2 text-sm text-primary-600">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Tautan -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <h2 class="text-sm font-semibold text-neutral-700 mb-4">Tautan</h2>
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

            <!-- Section 6: Anggota Tim -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <x-input-label value="Anggota Tim" class="mb-2" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
                    <x-text-input wire:model="newMemberName" type="text" placeholder="Nama anggota..." class="block w-full text-sm" />
                    <div class="flex gap-2">
                        <x-text-input wire:model="newMemberRole" type="text" placeholder="Peran dalam tim..." class="block w-full text-sm" x-on:keydown.enter.prevent="$wire.addMember()" />
                        <button type="button" wire:click="addMember" class="px-3 py-2 bg-primary-600 text-white text-sm rounded-md hover:bg-primary-900 transition-colors shrink-0">Tambah</button>
                    </div>
                </div>
                <div class="space-y-2 mb-3">
                    @foreach($members as $index => $member)
                        <div class="flex items-center justify-between px-3 py-2 rounded-lg bg-neutral-50 border border-neutral-200">
                            <div class="flex items-center gap-2 text-sm">
                                <span class="font-medium text-neutral-700">{{ $member['name'] }}</span>
                                @if($member['role'])
                                    <span class="text-neutral-400">—</span>
                                    <span class="text-neutral-500">{{ $member['role'] }}</span>
                                @endif
                            </div>
                            <button type="button" wire:click="removeMember({{ $index }})" class="text-neutral-400 hover:text-red-600 text-sm">&times;</button>
                        </div>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('newMemberName')" class="mt-1" />
                <x-input-error :messages="$errors->get('members.*.name')" class="mt-1" />
            </div>

            <!-- Section 7: Teknologi -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <x-input-label value="Teknologi" class="mb-2" />
                <div class="flex gap-2 mb-3">
                    <x-text-input wire:model="newTechnology" type="text" placeholder="Tambah teknologi..." class="block w-full text-sm" x-on:keydown.enter.prevent="$wire.addTechnology()" />
                    <button type="button" wire:click="addTechnology" class="px-3 py-2 bg-primary-600 text-white text-sm rounded-md hover:bg-primary-900 transition-colors shrink-0">Tambah</button>
                </div>
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach($technologies as $index => $tech)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg bg-primary-600/10 text-primary-600 text-sm font-medium">
                            {{ $tech }}
                            <button type="button" wire:click="removeTechnology({{ $index }})" class="ml-1.5 hover:text-red-600">&times;</button>
                        </span>
                    @endforeach
                </div>
                <x-input-error :messages="$errors->get('newTechnology')" class="mt-1" />
            </div>

            <!-- Section 8: SEO Metadata -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden" x-data="{ open: false }">
                <button type="button" @click="open = !open" class="w-full flex items-center justify-between p-6 text-left hover:bg-neutral-50 transition-colors">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-neutral-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                        <span class="font-medium text-neutral-800">Pengaturan SEO</span>
                        <span class="text-xs text-neutral-400">(opsional)</span>
                    </div>
                    <svg class="w-5 h-5 text-neutral-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-collapse class="px-6 pb-6 space-y-4 border-t border-neutral-100 pt-4">
                    <div>
                        <x-input-label for="meta_title" value="Meta Title" />
                        <x-text-input id="meta_title" wire:model="meta_title" type="text" class="mt-1 block w-full" placeholder="Biarkan kosong untuk auto-generate dari judul" />
                        <x-input-error :messages="$errors->get('meta_title')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="meta_description" value="Meta Description" />
                        <textarea id="meta_description" wire:model="meta_description" rows="3" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Biarkan kosong untuk auto-generate dari deskripsi singkat"></textarea>
                        <x-input-error :messages="$errors->get('meta_description')" class="mt-1" />
                    </div>
                    <div>
                        <x-input-label for="meta_keywords" value="Meta Keywords" />
                        <textarea id="meta_keywords" wire:model="meta_keywords" rows="2" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Pisahkan dengan koma. Biarkan kosong untuk auto-generate dari teknologi"></textarea>
                        <x-input-error :messages="$errors->get('meta_keywords')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 9: Status -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <x-input-label value="Status" class="mb-3" />
                <div class="flex gap-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" value="draft" class="border-neutral-300 text-primary-600 focus:ring-primary-600">
                        <span class="ml-2 text-sm text-neutral-700">Draft</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model="status" value="publish" class="border-neutral-300 text-primary-600 focus:ring-primary-600">
                        <span class="ml-2 text-sm text-neutral-700">Publish</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('status')" class="mt-1" />
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.projects') }}" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</a>
                <x-primary-button type="submit" wire:loading.attr="disabled" wire:target="save,thumbnail">{{ $project ? 'Simpan Perubahan' : 'Tambah Proyek' }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
