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
        <h1 class="text-xl font-bold text-neutral-800">Manajemen Keahlian</h1>
        <button wire:click="openCategoryModal" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kategori
        </button>
    </div>

    <!-- Categories List -->
    @if($categories->isEmpty())
        <div class="text-center py-12 text-neutral-500">
            Belum ada kategori keahlian.
        </div>
    @else
        @foreach($categories as $category)
            <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden mb-6" wire:key="category-{{ $category->id }}">
                <!-- Category Header -->
                <div class="bg-neutral-50 px-5 py-4 border-b border-neutral-200 flex items-center justify-between">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-primary-600 text-white text-sm font-medium">
                            {{ $category->name_id }}
                        </span>
                        @if($category->name_en)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-md bg-neutral-100 text-neutral-600 text-sm">
                                {{ $category->name_en }}
                            </span>
                        @endif
                    </div>
                    <div class="flex items-center gap-1">
                        <button wire:click="editCategory({{ $category->id }})" class="p-1.5 text-neutral-500 hover:text-primary-600 hover:bg-primary-50 rounded-md transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button wire:click="confirmCategoryDelete({{ $category->id }})" class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>

                <!-- Category Body -->
                <div class="p-5">
                    <p class="text-sm text-neutral-500 mb-3">Urutan: {{ $category->sort_order }}</p>

                    <!-- Skills -->
                    @if($category->skills->isNotEmpty())
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($category->skills as $skill)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-neutral-100 text-sm text-neutral-700" wire:key="skill-{{ $skill->id }}">
                                    <span class="font-medium">{{ $skill->name_id }}</span>
                                    @if($skill->name_en)
                                        <span class="text-xs text-neutral-500">{{ $skill->name_en }}</span>
                                    @endif
                                    <button wire:click="editSkill({{ $skill->id }})" class="ml-1 p-0.5 text-neutral-400 hover:text-primary-600 rounded transition-colors" title="Edit">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="confirmSkillDelete({{ $skill->id }})" class="p-0.5 text-neutral-400 hover:text-red-600 rounded transition-colors" title="Hapus">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-neutral-400 mb-4">Belum ada skill dalam kategori ini.</p>
                    @endif

                    <button wire:click="openSkillModal({{ $category->id }})" class="inline-flex items-center px-3 py-1.5 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Skill
                    </button>
                </div>
            </div>
        @endforeach
    @endif

    <!-- Category Modal -->
    <x-modal name="category-modal" :show="false">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">{{ $editingCategoryId ? 'Edit Kategori' : 'Tambah Kategori' }}</h3>

            <form wire:submit="saveCategory">
                <div class="space-y-4">
                    <div>
                        <x-input-label for="categoryNameId" value="Nama Kategori (ID)" />
                        <x-text-input id="categoryNameId" wire:model="categoryNameId" type="text" class="mt-1 block w-full" placeholder="Masukkan nama kategori bahasa Indonesia" />
                        <x-input-error :messages="$errors->get('categoryNameId')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="categoryNameEn" value="Nama Kategori (EN)" />
                        <x-text-input id="categoryNameEn" wire:model="categoryNameEn" type="text" class="mt-1 block w-full" placeholder="Masukkan nama kategori bahasa Inggris (opsional)" />
                        <x-input-error :messages="$errors->get('categoryNameEn')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="categorySortOrder" value="Urutan" />
                        <x-text-input id="categorySortOrder" wire:model="categorySortOrder" type="number" min="0" class="mt-1 block w-full" placeholder="0" />
                        <x-input-error :messages="$errors->get('categorySortOrder')" class="mt-1" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="closeCategoryModal" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-primary-button type="submit">{{ $editingCategoryId ? 'Simpan Perubahan' : 'Tambah Kategori' }}</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Skill Modal -->
    <x-modal name="skill-modal" :show="false">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">{{ $editingSkillId ? 'Edit Skill' : 'Tambah Skill' }}</h3>

            <form wire:submit="saveSkill">
                <input type="hidden" wire:model="skillCategoryId">

                <div class="space-y-4">
                    <div>
                        <x-input-label for="skillNameId" value="Nama Skill (ID)" />
                        <x-text-input id="skillNameId" wire:model="skillNameId" type="text" class="mt-1 block w-full" placeholder="Masukkan nama skill bahasa Indonesia" />
                        <x-input-error :messages="$errors->get('skillNameId')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="skillNameEn" value="Nama Skill (EN)" />
                        <x-text-input id="skillNameEn" wire:model="skillNameEn" type="text" class="mt-1 block w-full" placeholder="Masukkan nama skill bahasa Inggris (opsional)" />
                        <x-input-error :messages="$errors->get('skillNameEn')" class="mt-1" />
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="closeSkillModal" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-primary-button type="submit">{{ $editingSkillId ? 'Simpan Perubahan' : 'Tambah Skill' }}</x-primary-button>
                </div>
            </form>
        </div>
    </x-modal>

    <!-- Category Delete Confirmation Modal -->
    @if($confirmingCategoryDelete)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50" wire:click="$set('confirmingCategoryDelete', null)"></div>
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 z-10 p-6">
                <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-neutral-500 mb-6">Menghapus kategori akan juga menghapus semua skill di dalamnya. Lanjutkan?</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="$set('confirmingCategoryDelete', null)" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-danger-button wire:click="deleteCategory">Hapus</x-danger-button>
                </div>
            </div>
        </div>
    @endif

    <!-- Skill Delete Confirmation Modal -->
    @if($confirmingSkillDelete)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="fixed inset-0 bg-black/50" wire:click="$set('confirmingSkillDelete', null)"></div>
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full mx-4 z-10 p-6">
                <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                <p class="text-sm text-neutral-500 mb-6">Apakah Anda yakin ingin menghapus skill ini?</p>
                <div class="flex justify-end gap-3">
                    <button wire:click="$set('confirmingSkillDelete', null)" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-danger-button wire:click="deleteSkill">Hapus</x-danger-button>
                </div>
            </div>
        </div>
    @endif
</div>
