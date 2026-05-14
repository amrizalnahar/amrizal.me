<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ContactTable extends Component
{
    use WithPagination;

    public string $search = '';

    public string $statusFilter = '';

    public string $sortField = 'created_at';

    public string $sortDirection = 'desc';

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
    public function contacts()
    {
        return Contact::query()
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%')
                        ->orWhere('subject', 'like', '%'.$this->search.'%');
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
        $contact = Contact::find($id);
        if ($contact) {
            $this->deleteId = $id;
            $this->deleteTitle = $contact->name;
        }
    }

    public function delete(): void
    {
        if (! $this->deleteId) {
            return;
        }

        $contact = Contact::findOrFail($this->deleteId);
        $contact->delete();

        $this->deleteId = null;
        $this->deleteTitle = null;
        $this->dispatch('notify', type: 'success', message: 'Pesan kontak berhasil dihapus.');
    }

    public function markAsRead(int $id): void
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();
        $this->dispatch('notify', type: 'success', message: 'Pesan ditandai sudah dibaca.');
    }

    public function markAsUnread(int $id): void
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'unread', 'read_at' => null]);
        $this->dispatch('notify', type: 'success', message: 'Pesan ditandai belum dibaca.');
    }

    public function render()
    {
        return view('livewire.admin.contact-table');
    }
}
