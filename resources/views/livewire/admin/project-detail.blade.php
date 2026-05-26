<div>
    <!-- Toast -->
    <div x-data="{ show: false, message: '', type: 'success' }"
         x-on:notify.window="show = true; message = $event.detail.message; type = $event.detail.type; setTimeout(() => show = false, 3000)"
         x-show="show" x-transition
         class="fixed top-5 right-5 z-50 px-4 py-3 rounded-lg shadow-lg text-white text-sm font-medium"
         :class="type === 'success' ? 'bg-green-600' : 'bg-red-600'"
         style="display: none;"
    >
        <span x-text="message"></span>
    </div>

    <div class="max-w-4xl mx-auto">
        <!-- Back Link -->
        <a href="{{ route('admin.projects') }}" class="inline-flex items-center text-sm text-neutral-500 hover:text-primary-600 mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Proyek
        </a>

        <h1 class="text-xl font-bold text-neutral-800 mb-6">Detail Proyek</h1>

        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
            @if($project->thumbnail)
                <div class="w-full h-64">
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-full h-64 bg-neutral-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif

            <div class="p-6 space-y-6">
                <!-- Status & Views -->
                <div class="flex items-center justify-between">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $project->status === 'publish' ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-600' }}">
                        {{ $project->status === 'publish' ? 'Published' : 'Draft' }}
                    </span>
                    <span class="text-sm text-neutral-500">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        {{ number_format($project->views) }} Views
                    </span>
                </div>

                <!-- Titles -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Judul (ID)</div>
                        <div class="text-neutral-800 font-medium text-lg">{{ $project->title_id }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Judul (EN)</div>
                        <div class="text-neutral-800 font-medium text-lg">{{ $project->title_en ?: '-' }}</div>
                    </div>
                </div>

                <!-- Meta Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Slug</div>
                        <div class="text-neutral-600 text-sm">{{ $project->slug }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Tipe</div>
                        <div class="text-neutral-600 text-sm">{{ $project->type }}</div>
                    </div>
                </div>

                <!-- Meta Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Perusahaan</div>
                        <div class="text-neutral-600 text-sm">{{ $project->company_name ?: '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Periode</div>
                        <div class="text-neutral-600 text-sm">{{ $project->period ?: '-' }}</div>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Deskripsi Singkat (ID)</div>
                        <div class="text-neutral-800">{!! $project->short_description_id !!}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Deskripsi Singkat (EN)</div>
                        <div class="text-neutral-800">{!! $project->short_description_en ?: '-' !!}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Deskripsi Lengkap (ID)</div>
                        <div class="text-neutral-800">{!! $project->full_description_id !!}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Deskripsi Lengkap (EN)</div>
                        <div class="text-neutral-800">{!! $project->full_description_en ?: '-' !!}</div>
                    </div>
                </div>

                <!-- Technologies -->
                <div>
                    <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Teknologi</div>
                    @if($project->technologies->isNotEmpty())
                        <div class="flex flex-wrap gap-2">
                            @foreach($project->technologies as $tech)
                                <span class="bg-neutral-100 text-neutral-600 rounded px-2 py-1 text-sm">{{ $tech->technology_name }}</span>
                            @endforeach
                        </div>
                    @else
                        <div class="text-neutral-500 text-sm">-</div>
                    @endif
                </div>

                <!-- Members -->
                <div>
                    <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Anggota Tim</div>
                    @if($project->members->isNotEmpty())
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($project->members as $member)
                                <li>{{ $member->name }} @if($member->role) – {{ $member->role }} @endif</li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-neutral-500 text-sm">-</div>
                    @endif
                </div>

                <!-- Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Demo URL</div>
                        @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="text-primary-600 hover:underline">{{ $project->demo_url }}</a>
                        @else
                            <span class="text-neutral-500">-</span>
                        @endif
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Repo URL</div>
                        @if($project->repo_url)
                            <a href="{{ $project->repo_url }}" target="_blank" class="text-primary-600 hover:underline">{{ $project->repo_url }}</a>
                        @else
                            <span class="text-neutral-500">-</span>
                        @endif
                    </div>
                </div>

                <hr class="border-neutral-200" />

                <!-- SEO Metadata -->
                <div>
                    <div class="text-sm font-semibold text-neutral-800 mb-3">SEO Metadata</div>
                    <div class="space-y-4 bg-neutral-50 rounded-lg p-4">
                        <div>
                        <div class="flex items-center gap-2 mb-1">
                            <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Title</div>
                            @if(!$project->meta_title)
                                <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span>
                            @endif
                        </div>
                        <div class="text-neutral-700 text-sm">{{ $project->seo_title ?: '-' }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Description</div>
                                @if(!$project->meta_description)
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span>
                                @endif
                            </div>
                            <div class="text-neutral-700 text-sm">{{ $project->seo_description ?: '-' }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Keywords</div>
                                @if(!$project->meta_keywords)
                                    <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span>
                                @endif
                            </div>
                            <div class="text-neutral-700 text-sm">{{ $project->seo_keywords ?: '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-200 flex flex-wrap gap-3" x-data="{ showDeleteModal: false }">
                @can('projects-edit')
                    <a href="{{ route('admin.projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit Proyek
                    </a>
                @endcan
                @can('projects-delete')
                    <button @click="showDeleteModal = true" class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Hapus Proyek
                    </button>
                    <!-- Delete Confirmation Modal -->
                    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
                        <div class="absolute inset-0 bg-black/50" @click="showDeleteModal = false"></div>
                        <div class="relative bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
                            <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                            <p class="text-sm text-neutral-600 mb-4">Yakin ingin menghapus proyek ini? Tindakan ini tidak dapat dibatalkan.</p>
                            <div class="flex justify-end gap-2">
                                <button @click="showDeleteModal = false" class="px-4 py-2 bg-neutral-100 text-neutral-700 text-xs font-medium rounded-lg hover:bg-neutral-200 transition-colors">Batal</button>
                                <button wire:click="delete" wire:loading.attr="disabled" @click="showDeleteModal = false" class="px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 transition-colors">Hapus</button>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>
