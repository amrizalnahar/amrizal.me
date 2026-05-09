<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.certificates') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">{{ $certificate ? 'Edit Sertifikat' : 'Tambah Sertifikat' }}</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Section 1: Informasi Dasar -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title ID -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="title_id" value="Judul Sertifikat" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#1A6FAA] text-white">ID</span>
                        </div>
                        <x-text-input id="title_id" wire:model="title_id" type="text" class="mt-1 block w-full" placeholder="Masukkan judul sertifikat" />
                        <x-input-error :messages="$errors->get('title_id')" class="mt-1" />
                    </div>

                    <!-- Title EN -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="title_en" value="Judul Sertifikat" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">EN</span>
                        </div>
                        <x-text-input id="title_en" wire:model="title_en" type="text" class="mt-1 block w-full" placeholder="Enter certificate title in English (optional)" />
                        <x-input-error :messages="$errors->get('title_en')" class="mt-1" />
                    </div>

                    <!-- Issuer Name -->
                    <div class="md:col-span-2">
                        <x-input-label for="issuer_name" value="Nama Penerbit" />
                        <x-text-input id="issuer_name" wire:model="issuer_name" type="text" class="mt-1 block w-full" placeholder="Masukkan nama penerbit sertifikat" />
                        <x-input-error :messages="$errors->get('issuer_name')" class="mt-1" />
                    </div>

                    <!-- Sort Order -->
                    <div class="md:col-span-2">
                        <x-input-label for="sort_order" value="Urutan" />
                        <input type="number" id="sort_order" wire:model="sort_order" min="0" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('sort_order')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Deskripsi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Description ID -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="description_id" value="Deskripsi" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#1A6FAA] text-white">ID</span>
                        </div>
                        <textarea id="description_id" wire:model="description_id" rows="4" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Masukkan deskripsi sertifikat dalam Bahasa Indonesia"></textarea>
                        <x-input-error :messages="$errors->get('description_id')" class="mt-1" />
                    </div>

                    <!-- Description EN -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="description_en" value="Deskripsi" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">EN</span>
                        </div>
                        <textarea id="description_en" wire:model="description_en" rows="4" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Enter certificate description in English (optional)"></textarea>
                        <x-input-error :messages="$errors->get('description_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 3: Logo Penerbit -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Logo Penerbit" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($issuer_logo)
                        <div class="relative">
                            <img src="{{ $issuer_logo->temporaryUrl() }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('issuer_logo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingIssuerLogo)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingIssuerLogo) }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('existingIssuerLogo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="issuer_logo" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('issuer_logo')" class="mt-1" />
                        <div wire:loading wire:target="issuer_logo" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Section 4: Gambar Sertifikat -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Gambar Sertifikat" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($certificate_image)
                        <div class="relative">
                            <img src="{{ $certificate_image->temporaryUrl() }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('certificate_image', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingCertificateImage)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingCertificateImage) }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('existingCertificateImage', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="certificate_image" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('certificate_image')" class="mt-1" />
                        <div wire:loading wire:target="certificate_image" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Section 5: Periode -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Issued At -->
                    <div>
                        <x-input-label for="issued_at" value="Tanggal Terbit" />
                        <input type="date" id="issued_at" wire:model="issued_at" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <x-input-error :messages="$errors->get('issued_at')" class="mt-1" />
                    </div>

                    <!-- Expired At -->
                    <div>
                        <x-input-label for="expired_at" value="Tanggal Kedaluwarsa" />
                        <input type="date" id="expired_at" wire:model="expired_at" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" />
                        <p class="mt-1 text-xs text-gray-400">Kosongkan jika sertifikat tidak memiliki tanggal kedaluwarsa.</p>
                        <x-input-error :messages="$errors->get('expired_at')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Section 6: Verifikasi -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label for="verify_url" value="URL Verifikasi" />
                <x-text-input id="verify_url" wire:model="verify_url" type="text" class="mt-1 block w-full" placeholder="https://..." />
                <x-input-error :messages="$errors->get('verify_url')" class="mt-1" />
            </div>

            <!-- Section 7: Status -->
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
                <a href="{{ route('admin.certificates') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                <x-primary-button type="submit">{{ $certificate ? 'Simpan Perubahan' : 'Tambah Sertifikat' }}</x-primary-button>
            </div>
        </form>
    </div>
</div>
