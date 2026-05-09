<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ContactDetail extends Component
{
    public Contact $contact;

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
        if ($this->contact->status === 'unread') {
            $this->contact->markAsRead();
        }
    }

    public function markAsUnread(): void
    {
        $this->contact->update(['status' => 'unread', 'read_at' => null]);
        $this->contact->refresh();
        $this->dispatch('notify', type: 'success', message: 'Pesan ditandai belum dibaca.');
    }

    public function delete(): void
    {
        $this->contact->delete();
        $this->dispatch('notify', type: 'success', message: 'Pesan berhasil dihapus.');
        $this->redirectRoute('admin.contacts');
    }

    public function render()
    {
        return view('livewire.admin.contact-detail');
    }
}
