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

    <div class="max-w-3xl">
        <h1 class="text-xl font-bold text-neutral-800 mb-6">Pengaturan Situs</h1>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6 space-y-8">
            <!-- Identitas Situs -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Identitas Situs</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Nama Situs</label>
                        <input wire:model="siteName" type="text" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('siteName') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Deskripsi Situs</label>
                        <textarea wire:model="siteDescription" rows="3" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm"></textarea>
                        @error('siteDescription') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Logo</label>
                        @if($existingLogo && !$siteLogo)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingLogo) }}" alt="Logo" class="h-16 w-auto rounded-lg object-contain border border-neutral-200">
                            </div>
                        @endif
                        @if($siteLogo)
                            <div class="mb-2">
                                <img src="{{ $siteLogo->temporaryUrl() }}" alt="Preview" class="h-16 w-auto rounded-lg object-contain border border-neutral-200">
                            </div>
                        @endif
                        <input wire:model="siteLogo" type="file" class="block w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-900">
                        @error('siteLogo') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Favicon</label>
                        @if($existingFavicon && !$siteFavicon)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $existingFavicon) }}" alt="Favicon" class="h-8 w-8 rounded-lg object-contain border border-neutral-200">
                            </div>
                        @endif
                        @if($siteFavicon)
                            <div class="mb-2">
                                <img src="{{ $siteFavicon->temporaryUrl() }}" alt="Preview" class="h-8 w-8 rounded-lg object-contain border border-neutral-200">
                            </div>
                        @endif
                        <input wire:model="siteFavicon" type="file" class="block w-full text-sm text-neutral-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-600 file:text-white hover:file:bg-primary-900">
                        @error('siteFavicon') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Kontak -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Kontak</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Email Kontak</label>
                        <input wire:model="contactEmail" type="text" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('contactEmail') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Telepon</label>
                        <input wire:model="contactPhone" type="text" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('contactPhone') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Alamat</label>
                        <textarea wire:model="contactAddress" rows="2" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm"></textarea>
                        @error('contactAddress') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Email Sistem -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Email Sistem</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Email Pengirim (MAIL_FROM_ADDRESS)</label>
                        <input wire:model="mailFromAddress" type="text" placeholder="admin@secret-campaign.test" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('mailFromAddress') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-neutral-500">Alamat email yang digunakan sebagai pengirim untuk semua notifikasi sistem.</p>
                    </div>
                </div>
            </div>

            <!-- Media Sosial -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Media Sosial</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Facebook</label>
                        <input wire:model="socialFacebook" type="text" placeholder="https://facebook.com/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('socialFacebook') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Instagram</label>
                        <input wire:model="socialInstagram" type="text" placeholder="https://instagram.com/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('socialInstagram') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">WhatsApp</label>
                        <input wire:model="socialWhatsapp" type="text" placeholder="https://wa.me/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('socialWhatsapp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">TikTok</label>
                        <input wire:model="socialTiktok" type="text" placeholder="https://tiktok.com/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('socialTiktok') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Portfolio -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Portfolio</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">GitHub URL</label>
                        <input wire:model="githubUrl" type="text" placeholder="https://github.com/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('githubUrl') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">LinkedIn URL</label>
                        <input wire:model="linkedinUrl" type="text" placeholder="https://linkedin.com/in/..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('linkedinUrl') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Lokasi</label>
                        <input wire:model="location" type="text" placeholder="Kota, Negara" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('location') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">WhatsApp (Nomor)</label>
                        <input wire:model="contactWhatsapp" type="text" placeholder="+62..." class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('contactWhatsapp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Bahasa Default</label>
                        <select wire:model="defaultLanguage" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                            <option value="id">Indonesia</option>
                            <option value="en">English</option>
                        </select>
                        @error('defaultLanguage') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">Tema Default</label>
                        <select wire:model="defaultTheme" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                            <option value="light">Light</option>
                            <option value="dark">Dark</option>
                        </select>
                        @error('defaultTheme') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Setting SEO -->
            <div>
                <h2 class="text-sm font-semibold text-neutral-700 mb-4 pb-2 border-b border-neutral-100">Setting SEO</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">SEO Site Name</label>
                        <input wire:model="seoSiteName" type="text" placeholder="Nama situs untuk SEO" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('seoSiteName') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">SEO Description</label>
                        <textarea wire:model="seoDescription" rows="3" placeholder="Deskripsi default untuk meta tag" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm"></textarea>
                        @error('seoDescription') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">SEO Author</label>
                        <input wire:model="seoAuthor" type="text" placeholder="Nama author / tim" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('seoAuthor') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-700 mb-1">GA4 Measurement ID</label>
                        <input wire:model="ga4MeasurementId" type="text" placeholder="G-XXXXXXXXXX" class="w-full border-neutral-300 focus:border-primary-600 focus:ring-primary-600 rounded-lg text-sm">
                        @error('ga4MeasurementId') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        <p class="mt-1 text-xs text-neutral-500">Contoh: G-ABC123DEF0. Kosongkan jika tidak menggunakan Google Analytics.</p>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-neutral-100">
                @can('settings-edit')
                <button wire:click="save" wire:loading.attr="disabled" wire:target="save,siteLogo,siteFavicon" class="px-6 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                    Simpan Pengaturan
                </button>
                @endcan
            </div>
        </div>
    </div>
</div>
