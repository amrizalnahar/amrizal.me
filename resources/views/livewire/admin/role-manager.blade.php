<div>
    <!-- Toast Notification -->
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show" x-transition
         class="fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm font-medium"
         :class="type === 'success' ? 'bg-green-600' : 'bg-red-600'"
         style="display: none;">
        <span x-text="message"></span>
    </div>

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-xl font-bold text-neutral-800">Manajemen Roles</h1>
        @can('roles-create')
        <button wire:click="openModal" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Role
        </button>
        @endcan
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-neutral-50 text-neutral-600 font-medium border-b border-neutral-200">
                    <tr>
                        <th class="px-5 py-3">Nama Role</th>
                        <th class="px-5 py-3 text-center">Jumlah User</th>
                        <th class="px-5 py-3 text-center">Permission</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-100">
                    @forelse ($roles as $role)
                        <tr class="hover:bg-neutral-50 transition-colors" wire:key="row-{{ $role->id }}">
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center gap-2">
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium
                                        @if($role->name === 'super-admin') bg-purple-100 text-purple-700
                                        @elseif($role->name === 'editor') bg-primary-100 text-primary-700
                                        @elseif($role->name === 'viewer') bg-neutral-100 text-neutral-600
                                        @else bg-emerald-100 text-emerald-700 @endif">
                                        {{ $role->name }}
                                    </span>
                                    @if($role->name === 'super-admin')
                                        <svg class="w-4 h-4 text-purple-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                    @endif
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-neutral-100 text-xs font-semibold text-neutral-700">{{ $role->users_count }}</span>
                            </td>
                            <td class="px-5 py-3.5 text-center text-neutral-500">{{ $role->permissions->count() }}</td>
                            <td class="px-5 py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('roles-edit')
                                    <button wire:click="editRolePermissions({{ $role->id }})" class="px-2.5 py-1 text-xs font-medium text-primary-600 bg-primary-50 rounded-md hover:bg-primary-100 transition-colors">
                                        Edit Permission
                                    </button>
                                    <button wire:click="edit({{ $role->id }})" class="p-1.5 text-neutral-500 hover:text-primary-600 hover:bg-primary-50 rounded-md transition-colors" title="Edit Nama">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    @endcan
                                    @can('roles-delete')
                                    @if($role->name !== 'super-admin')
                                    <button wire:click="confirmDelete({{ $role->id }})" class="p-1.5 text-neutral-500 hover:text-red-600 hover:bg-red-50 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-8 text-center text-neutral-500">Tidak ada data role.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Permission Editor Panel -->
    @if($editingRoleId)
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6 mt-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-neutral-800">Edit Permission: <span class="capitalize">{{ $editingRoleName }}</span></h2>
                <button wire:click="cancelEditPermissions" class="text-sm text-neutral-500 hover:text-neutral-700">Batal</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-neutral-50 text-neutral-600 font-medium border-b border-neutral-200">
                        <tr>
                            <th class="px-4 py-3">Modul</th>
                            @foreach(['list', 'create', 'edit', 'delete', 'export', 'access', 'execute'] as $action)
                                <th class="px-4 py-3 text-center">{{ $actionLabels[$action] ?? ucfirst($action) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        @foreach($permissionGroups as $module => $permissions)
                            <tr class="hover:bg-neutral-50" wire:key="perm-row-{{ $loop->index }}">
                                <td class="px-4 py-3 font-medium text-neutral-700">{{ $module }}</td>
                                @foreach(['list', 'create', 'edit', 'delete', 'export', 'access', 'execute'] as $action)
                                    <td class="px-4 py-3 text-center">
                                        @php
                                            $permName = collect($permissions)->first(fn($p) => str_ends_with($p, '-' . $action));
                                        @endphp
                                        @if($permName)
                                            <label class="inline-flex items-center cursor-pointer">
                                                <input type="checkbox" wire:model="selectedPermissions" value="{{ $permName }}"
                                                       class="w-4 h-4 text-primary-600 border-neutral-300 rounded focus:ring-primary-600">
                                            </label>
                                        @else
                                            <span class="text-neutral-300">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button wire:click="cancelEditPermissions" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                <button wire:click="savePermissions" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors">Simpan Permission</button>
            </div>
        </div>
    @endif

    <!-- Role Form Modal -->
    <x-modal name="role-modal" :show="false">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-neutral-800 mb-4">{{ $editingId ? 'Edit Role' : 'Tambah Role' }}</h3>

            <form wire:submit="save">
                <div>
                    <x-input-label for="role_name" value="Nama Role" />
                    <x-text-input id="role_name" wire:model="name" type="text" class="mt-1 block w-full" placeholder="Masukkan nama role" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    <x-primary-button type="submit">{{ $editingId ? 'Simpan Perubahan' : 'Tambah Role' }}</x-primary-button>
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
                @if($deleteError)
                    <div class="mb-4 rounded-lg px-4 py-3 text-sm bg-red-50 text-red-700 border border-red-200 flex items-start gap-3">
                        <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ $deleteError }}</span>
                    </div>
                @else
                    <p class="text-sm text-neutral-500 mb-6">Apakah Anda yakin ingin menghapus role ini? Data akan dipindahkan ke tong sampah.</p>
                @endif
                <div class="flex justify-end gap-3">
                    <button wire:click="cancelDelete" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                    @if(!$deleteError)
                        <x-danger-button wire:click="delete">Hapus</x-danger-button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
