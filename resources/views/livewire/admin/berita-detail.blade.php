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

    <div class="max-w-4xl mx-auto">
        <!-- Back Link -->
        <a href="{{ route('admin.blog') }}" class="inline-flex items-center text-sm text-neutral-500 hover:text-primary-600 mb-4 transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Artikel
        </a>

        <h1 class="text-xl font-bold text-neutral-800 mb-6">Detail Artikel</h1>

        <!-- Content Card -->
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 overflow-hidden">
            @if($post->thumbnail)
                <div class="w-full h-64">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail" class="w-full h-full object-cover">
                </div>
            @else
                <div class="w-full h-64 bg-neutral-100 flex items-center justify-center">
                    <svg class="w-16 h-16 text-neutral-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif

            <div class="p-6 space-y-6">
                <!-- Status & Views -->
                <div class="flex items-center justify-between">
                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-neutral-100 text-neutral-600' }}">
                        {{ $post->status === 'published' ? 'Published' : 'Draft' }}
                    </span>
                    <span class="text-sm text-neutral-500">
                        <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        {{ number_format($post->views) }} Views
                    </span>
                </div>

                <!-- Titles -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Judul (ID)</div>
                        <div class="text-neutral-800 font-medium text-lg">{{ $post->title_id }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Judul (EN)</div>
                        <div class="text-neutral-800 font-medium text-lg">{{ $post->title_en ?: '-' }}</div>
                    </div>
                </div>

                <!-- Meta Row 1 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Slug</div>
                        <div class="text-neutral-600 text-sm">{{ $post->slug }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Kategori</div>
                        @if($post->category)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-100 text-primary-700">
                                {{ $post->category->name }}
                            </span>
                        @else
                            <span class="text-neutral-500 text-sm">-</span>
                        @endif
                    </div>
                </div>

                <!-- Meta Row 2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Tags</div>
                        <div class="flex flex-wrap gap-1">
                            @forelse($post->tags as $tag)
                                <span class="bg-neutral-100 text-neutral-600 rounded px-1.5 py-0.5 text-xs">
                                    {{ $tag->name }}
                                </span>
                            @empty
                                <span class="text-neutral-500 text-sm">-</span>
                            @endforelse
                        </div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Author</div>
                        <div class="text-neutral-600 text-sm">{{ $post->author?->name ?? '-' }}</div>
                    </div>
                </div>

                <!-- Meta Row 3 (Dates) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Tanggal Publish</div>
                        <div class="text-neutral-600 text-sm">{{ $post->published_at ? $post->published_at->translatedFormat('d M Y H:i') : '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Dibuat</div>
                        <div class="text-neutral-600 text-sm">{{ $post->created_at->translatedFormat('d M Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider mb-1">Diperbarui</div>
                        <div class="text-neutral-600 text-sm">{{ $post->updated_at->translatedFormat('d M Y H:i') }}</div>
                    </div>
                </div>

                <hr class="border-neutral-200">

                <!-- Content ID -->
                <div x-data="{ showRaw: false }">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Konten (ID)</div>
                        <div class="flex bg-neutral-100 rounded-lg p-0.5">
                            <button @click="showRaw = false" :class="!showRaw ? 'bg-white shadow-sm text-neutral-800' : 'text-neutral-500 hover:text-neutral-700'" class="px-3 py-1 text-xs font-medium rounded-md transition-colors">Rendered</button>
                            <button @click="showRaw = true" :class="showRaw ? 'bg-white shadow-sm text-neutral-800' : 'text-neutral-500 hover:text-neutral-700'" class="px-3 py-1 text-xs font-medium rounded-md transition-colors">Raw</button>
                        </div>
                    </div>
                    <div x-show="!showRaw" x-transition class="prose prose-sm max-w-none text-neutral-800">
                        {!! $post->content_id !!}
                    </div>
                    <div x-show="showRaw" x-transition x-cloak class="bg-neutral-50 rounded-lg p-4 max-h-96 overflow-auto text-sm text-neutral-700 font-mono" style="display: none;">
                        <pre><code>{{ $post->content_id }}</code></pre>
                    </div>
                </div>

                <hr class="border-neutral-200">

                <!-- Content EN -->
                <div x-data="{ showRaw: false }">
                    <div class="flex items-center justify-between mb-2">
                        <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Konten (EN)</div>
                        @if($post->content_en)
                        <div class="flex bg-neutral-100 rounded-lg p-0.5">
                            <button @click="showRaw = false" :class="!showRaw ? 'bg-white shadow-sm text-neutral-800' : 'text-neutral-500 hover:text-neutral-700'" class="px-3 py-1 text-xs font-medium rounded-md transition-colors">Rendered</button>
                            <button @click="showRaw = true" :class="showRaw ? 'bg-white shadow-sm text-neutral-800' : 'text-neutral-500 hover:text-neutral-700'" class="px-3 py-1 text-xs font-medium rounded-md transition-colors">Raw</button>
                        </div>
                        @endif
                    </div>
                    @if($post->content_en)
                        <div x-show="!showRaw" x-transition class="prose prose-sm max-w-none text-neutral-800">
                            {!! $post->content_en !!}
                        </div>
                        <div x-show="showRaw" x-transition x-cloak class="bg-neutral-50 rounded-lg p-4 max-h-96 overflow-auto text-sm text-neutral-700 font-mono" style="display: none;">
                            <pre><code>{{ $post->content_en }}</code></pre>
                        </div>
                    @else
                        <div class="text-neutral-500 text-sm">-</div>
                    @endif
                </div>

                <hr class="border-neutral-200">

                <!-- SEO -->
                <div>
                    <div class="text-sm font-semibold text-neutral-800 mb-3">SEO Metadata</div>
                    <div class="space-y-4 bg-neutral-50 rounded-lg p-4">
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Title</div>
                                @if(!$post->meta_title) <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span> @endif
                            </div>
                            <div class="text-neutral-700 text-sm">{{ $post->seo_title ?: '-' }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Description</div>
                                @if(!$post->meta_description) <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span> @endif
                            </div>
                            <div class="text-neutral-700 text-sm">{{ $post->seo_description ?: '-' }}</div>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 mb-1">
                                <div class="text-xs font-medium text-neutral-400 uppercase tracking-wider">Meta Keywords</div>
                                @if(!$post->meta_keywords) <span class="text-[10px] px-1.5 py-0.5 rounded bg-primary-100 text-primary-700 font-medium">Auto-generated</span> @endif
                            </div>
                            <div class="text-neutral-700 text-sm">{{ $post->seo_keywords ?: '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-200 flex flex-wrap gap-3" x-data="{ showDeleteModal: false }">
                @can('posts-edit')
                    <a href="{{ route('admin.blog.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-900 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit Artikel
                    </a>
                @endcan

                @if($post->status === 'published')
                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-neutral-300 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        Preview Publik
                    </a>
                @endif

                @can('posts-delete')
                    <button
                        @click="showDeleteModal = true"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm"
                    >
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus Artikel
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div x-show="showDeleteModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" style="display: none;">
                        <div class="absolute inset-0 bg-black/50" @click="showDeleteModal = false"></div>
                        <div class="relative bg-white rounded-xl shadow-lg p-6 max-w-sm w-full mx-4">
                            <h3 class="text-lg font-semibold text-neutral-800 mb-2">Konfirmasi Hapus</h3>
                            <p class="text-sm text-neutral-600 mb-4 whitespace-normal">Yakin ingin menghapus artikel ini? Tindakan ini tidak dapat dibatalkan.</p>
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
