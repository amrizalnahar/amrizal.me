<?php

namespace App\Livewire\Admin;

use App\Models\Certificate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class CertificateTable extends Component
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
    public function certificates()
    {
        return Certificate::ordered()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('title_id', 'like', '%' . $this->search . '%')
                        ->orWhere('issuer_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($q) {
                $q->where('status', $this->statusFilter);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);
    }

    public function confirmDelete(int $id): void
    {
        $certificate = Certificate::find($id);
        if ($certificate) {
            $this->deleteId = $id;
            $this->deleteTitle = $certificate->title_id;
        }
    }

    public function delete(): void
    {
        if (! $this->deleteId) {
            return;
        }

        $certificate = Certificate::findOrFail($this->deleteId);
        $certificate->delete();

        $this->deleteId = null;
        $this->deleteTitle = null;
        $this->dispatch('notify', type: 'success', message: 'Sertifikat berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.certificate-table');
    }
}
