<?php

namespace App\Livewire\Admin;

use App\Models\Experience;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ExperienceTable extends Component
{
    use WithPagination;

    public string $search = '';

    public string $sortField = 'sort_order';

    public string $sortDirection = 'asc';

    public int $perPage = 10;

    public ?int $deleteId = null;

    public ?string $deleteTitle = null;

    public function updatingSearch(): void
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
    public function experiences()
    {
        return Experience::ordered()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('company_name', 'like', '%'.$this->search.'%')
                        ->orWhere('position', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function confirmDelete(int $id): void
    {
        $experience = Experience::find($id);
        if ($experience) {
            $this->deleteId = $id;
            $this->deleteTitle = $experience->company_name;
        }
    }

    public function delete(): void
    {
        if (! $this->deleteId) {
            return;
        }

        $experience = Experience::findOrFail($this->deleteId);
        $experience->delete();

        $this->deleteId = null;
        $this->deleteTitle = null;
        $this->dispatch('notify', type: 'success', message: 'Pengalaman kerja berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.experience-table');
    }
}
