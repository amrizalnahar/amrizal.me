<?php

namespace App\Livewire\Admin;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class BeritaDetail extends Component
{
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post->load(['category', 'tags', 'author']);
    }

    public function delete(): void
    {
        if ($this->post->thumbnail) {
            Storage::disk('public')->delete($this->post->thumbnail);
        }
        $this->post->delete();

        $this->dispatch('notify', type: 'success', message: 'Artikel berhasil dihapus.');
        $this->redirectRoute('admin.blog');
    }

    public function render()
    {
        return view('livewire.admin.berita-detail');
    }
}
