<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.experiences') }}" class="text-neutral-500 hover:text-neutral-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-neutral-800">{{ $experience ? 'Edit Pengalaman' : 'Tambah Pengalaman' }}</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Name -->
                    <div class="md:col-span-2">
                        <x-input-label for="company_name" value="Nama Perusahaan" />
                        <x-text-input id="company_name" wire:model="company_name" type="text" class="mt-1 block w-full" placeholder="Masukkan nama perusahaan" />
                        <x-input-error :messages="$errors->get('company_name')" class="mt-1" />
                    </div>

                    <!-- Position -->
                    <div class="md:col-span-2">
                        <x-input-label for="position" value="Posisi" />
                        <x-text-input id="position" wire:model="position" type="text" class="mt-1 block w-full" placeholder="Masukkan posisi/jabatan" />
                        <x-input-error :messages="$errors->get('position')" class="mt-1" />
                    </div>

                    <!-- Sort Order -->
                    <div class="md:col-span-2">
                        <x-input-label for="sort_order" value="Urutan" />
                        <input type="number" id="sort_order" wire:model="sort_order" min="0" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Deskripsi (Bilingual) -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Description ID -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="description_id" value="Deskripsi" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-600 text-white">ID</span>
                        </div>
                        <textarea id="description_id" wire:model="description_id" rows="4" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Masukkan deskripsi pekerjaan dalam Bahasa Indonesia"></textarea>
                        <x-input-error :messages="$errors->get('description_id')" class="mt-1" />
                    </div>

                    <!-- Description EN -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="description_en" value="Deskripsi" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-neutral-100 text-neutral-600">EN</span>
                        </div>
                        <textarea id="description_en" wire:model="description_en" rows="4" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" placeholder="Enter job description in English (optional)"></textarea>
                        <x-input-error :messages="$errors->get('description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
                <x-input-label value="Logo" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($logo)
                        <div class="relative">
                            <img src="{{ $logo->temporaryUrl() }}" class="w-32 h-32 rounded-lg object-cover border border-neutral-200">
                            <button type="button" wire:click="$set('logo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingLogo)
                        <div class="relative">
                            <img src="{{ Storage::url($existingLogo) }}" alt="Company Logo" class="w-32 h-32 rounded-lg object-cover border border-neutral-200">
                            <button type="button" wire:click="$set('existingLogo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="logo" accept="image/*"
                               class="block w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-900">
                        <p class="mt-1 text-xs text-neutral-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('logo')" class="mt-1" />
                        <div wire:loading.class.remove="hidden" wire:target="logo" class="hidden mt-2 text-sm text-primary-600">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Periode -->
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6" x-data="{ isCurrent: @entangle('is_current') }">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Started At -->
                    <div>
                        <x-input-label for="started_at" value="Tanggal Mulai" />
                        <input type="date" id="started_at" wire:model="started_at" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('started_at')" class="mt-1" />
                    </div>

                    <!-- Is Current -->
                    <div class="flex items-center md:pt-6">
                        <input type="checkbox" id="is_current" wire:model="is_current" x-on:change="isCurrent = $event.target.checked" class="rounded border-neutral-300 text-primary-600 focus:ring-primary-600">
                        <label for="is_current" class="ml-2 text-sm text-neutral-700">Masih bekerja di sini</label>
                    </div>

                    <!-- Ended At -->
                    <div class="md:col-span-2" x-show="!isCurrent">
                        <x-input-label for="ended_at" value="Tanggal Selesai" />
                        <input type="date" id="ended_at" wire:model="ended_at" class="mt-1 block w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('ended_at')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.experiences') }}" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</a>
                <x-primary-button type="submit">Simpan Pengalaman</x-primary-button>
            </div>
        </form>
    </div>
</div>
