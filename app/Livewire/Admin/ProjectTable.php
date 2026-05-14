<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ProjectTable extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public string $sortField = 'sort_order';

    public string $sortDirection = 'asc';

    public int $perPage = 10;

    public ?int $deleteId = null;

    public ?string $deleteTitle = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    #[Computed]
    public function projects()
    {
        return Project::ordered()
            ->with('technologies')
            ->when($this->search, function ($q) {
                $q->where(function ($sub) {
                    $sub->where('title_id', 'like', '%'.$this->search.'%')
                        ->orWhere('company_name', 'like', '%'.$this->search.'%')
                        ->orWhere('type', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->statusFilter, fn ($q) => $q->where('status', $this->statusFilter))
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function confirmDelete(int $id): void
    {
        $project = Project::find($id);
        if ($project) {
            $this->deleteId = $id;
            $this->deleteTitle = $project->title_id;
        }
    }

    public function delete(): void
    {
        if (! $this->deleteId) {
            return;
        }

        $project = Project::findOrFail($this->deleteId);
        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        $project->delete();

        $this->deleteId = null;
        $this->deleteTitle = null;
        $this->dispatch('notify', type: 'success', message: 'Proyek berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.project-table');
    }
}
