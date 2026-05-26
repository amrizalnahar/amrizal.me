<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ProjectDetail extends Component
{
    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project->load(['technologies', 'members']);
    }

    public function delete(): void
    {
        if ($this->project->thumbnail) {
            Storage::disk('public')->delete($this->project->thumbnail);
        }
        $this->project->delete();

        $this->dispatch('notify', type: 'success', message: 'Proyek berhasil dihapus.');
        $this->redirectRoute('admin.projects');
    }

    public function render()
    {
        return view('livewire.admin.project-detail');
    }
}
?>
