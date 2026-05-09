<div>
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">Profil Saya</h1>
        </div>

        <form wire:submit="save" class="space-y-6">
            <!-- Summary -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Summary ID -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="summary_id" value="Ringkasan" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-[#1A6FAA] text-white">ID</span>
                        </div>
                        <textarea id="summary_id" wire:model="summary_id" rows="5" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Masukkan ringkasan profil dalam Bahasa Indonesia"></textarea>
                        <x-input-error :messages="$errors->get('summary_id')" class="mt-1" />
                    </div>

                    <!-- Summary EN -->
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <x-input-label for="summary_en" value="Ringkasan" />
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-600">EN</span>
                        </div>
                        <textarea id="summary_en" wire:model="summary_en" rows="5" class="mt-1 block w-full border-gray-300 focus:border-[#1A6FAA] focus:ring-[#1A6FAA] rounded-md shadow-sm text-sm" placeholder="Enter profile summary in English (optional)"></textarea>
                        <x-input-error :messages="$errors->get('summary_en')" class="mt-1" />
                    </div>
                </div>
            </div>

            <!-- Photo -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="Foto Profil" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($photo)
                        <div class="relative">
                            <img src="{{ $photo->temporaryUrl() }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('photo', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingPhoto)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $existingPhoto) }}" class="w-32 h-32 rounded-lg object-cover border border-gray-200">
                            <button type="button" wire:click="$set('existingPhoto', null)" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="photo" accept="image/*"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maksimal 5MB.</p>
                        <x-input-error :messages="$errors->get('photo')" class="mt-1" />
                        <div wire:loading wire:target="photo" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- CV Indonesia -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="CV Indonesia" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($cv_id)
                        <div class="relative flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg border border-gray-200">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                            <span class="text-sm text-gray-700">{{ $cv_id->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('cv_id', null)" class="ml-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingCvId)
                        <div class="relative flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg border border-gray-200">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                            <a href="{{ asset('storage/' . $existingCvId) }}" target="_blank" class="text-sm text-[#1A6FAA] hover:underline">{{ basename($existingCvId) }}</a>
                            <button type="button" wire:click="$set('existingCvId', null)" class="ml-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="cv_id" accept=".pdf"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: PDF. Maksimal 10MB.</p>
                        <x-input-error :messages="$errors->get('cv_id')" class="mt-1" />
                        <div wire:loading wire:target="cv_id" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- CV English -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <x-input-label value="CV English" class="mb-2" />
                <div class="flex items-start gap-4">
                    @if($cv_en)
                        <div class="relative flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg border border-gray-200">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                            <span class="text-sm text-gray-700">{{ $cv_en->getClientOriginalName() }}</span>
                            <button type="button" wire:click="$set('cv_en', null)" class="ml-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @elseif($existingCvEn)
                        <div class="relative flex items-center gap-2 px-3 py-2 bg-gray-50 rounded-lg border border-gray-200">
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                            <a href="{{ asset('storage/' . $existingCvEn) }}" target="_blank" class="text-sm text-[#1A6FAA] hover:underline">{{ basename($existingCvEn) }}</a>
                            <button type="button" wire:click="$set('existingCvEn', null)" class="ml-2 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center text-xs hover:bg-red-600">&times;</button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="cv_en" accept=".pdf"
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#1A6FAA] file:text-white hover:file:bg-[#155a8a]">
                        <p class="mt-1 text-xs text-gray-400">Format: PDF. Maksimal 10MB.</p>
                        <x-input-error :messages="$errors->get('cv_en')" class="mt-1" />
                        <div wire:loading wire:target="cv_en" class="mt-2 text-sm text-[#1A6FAA]">Mengunggah...</div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-200 transition-colors">Batal</a>
                <x-primary-button type="submit">Simpan Profil</x-primary-button>
            </div>
        </form>
    </div>
</div>
