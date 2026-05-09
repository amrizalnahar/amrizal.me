<?php

namespace App\Livewire\Admin;

use App\Models\Education;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class EducationTable extends Component
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
    public function educations()
    {
        return Education::ordered()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('institution_name', 'like', '%' . $this->search . '%')
                        ->orWhere('degree', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function confirmDelete(int $id): void
    {
        $education = Education::find($id);
        if ($education) {
            $this->deleteId = $id;
            $this->deleteTitle = $education->institution_name;
        }
    }

    public function delete(): void
    {
        if (! $this->deleteId) {
            return;
        }

        $education = Education::findOrFail($this->deleteId);
        $education->delete();

        $this->deleteId = null;
        $this->deleteTitle = null;
        $this->dispatch('notify', type: 'success', message: 'Pendidikan berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.education-table');
    }
}
