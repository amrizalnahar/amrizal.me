<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.educations') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">{{ $education ? 'Edit Pendidikan' : 'Tambah Pendidikan' }}</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Institution Name -->
                    <div class="md:col-span-2">
                        <x-input-label for="institution_name" value="Nama Institusi" />
                        <x-text-input id="institution_name" wire:model="institution_name" type="text" class="mt-1 block w-full" placeholder="Masukkan nama institusi" />
                        <x-input-error :messages="$errors->get('institution_name')" class="mt-1" />
                    </div>

                    <!-- Degree -->
                    <div class="md:col-span-2">
                        <x-input-label for="degree" value="Gelar" />
                        <x-text-input id="degree" wire:model="degree" type="text" class="mt-1 block w-full" placeholder="Contoh: S1, S2, D3" />
                        <x-input-error :messages="$errors->get('degree')" class="mt-1" />
                    </div>

                    <!-- Sort Order -->
                    <div class="md:col-span-2">
                        <x-input-label for="sort_order" value="Urutan" />
                        <input type="number" id="sort_order" wire:model="sort_order" min="0" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Jurusan (Bilingual) -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Major ID -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="major_id" value="Jurusan" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#1A6FAA] text-white">ID</span>
                        </div>
                        <textarea id="major_id" wire:model="major_id" rows="3" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Masukkan jurusan dalam Bahasa Indonesia"></textarea>
                        <x-input-error :messages="$errors->get('major_id')" class="mt-1" />
                    </div>

                    <!-- Major EN -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="major_en" value="Jurusan" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">EN</span>
                        </div>
                        <textarea id="major_en" wire:model="major_en" rows="3" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Enter major in English (optional)"></textarea>
                        <x-input-error :messages="$errors->get('major_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Logo -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Logo" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($logo)
                        <div class="relative">
                            <img src="{{ $logo->temporaryUrl() }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('logo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingLogo)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingLogo) }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('existingLogo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="logo" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('logo')" class="mt-1" />
                        <div wire:loading wire:target="logo" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Periode -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Started At -->
                    <div>
                        <x-input-label for="started_at" value="Tahun Mulai" />
                        <input type="number" id="started_at" wire:model="started_at" min="1950" max="2050" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('started_at')" class="mt-1" />
                    </div>

                    <!-- Ended At -->
                    <div>
                        <x-input-label for="ended_at" value="Tahun Selesai" />
                        <input type="number" id="ended_at" wire:model="ended_at" min="1950" max="2050" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('ended_at')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.educations') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                <x-primary-button type="submit">Simpan Pendidikan</x-primary-button>
            </div>
        </form>
    </div>
</div>
