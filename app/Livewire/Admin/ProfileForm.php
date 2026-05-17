<?php

namespace App\Livewire\Admin;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class ProfileForm extends Component
{
    use WithFileUploads;

    public ?Profile $profile = null;

    public string $summary_id = '';

    public string $summary_en = '';

    public $photo = null;

    public ?string $existingPhoto = null;

    public $cv_id = null;

    public ?string $existingCvId = null;

    public $cv_en = null;

    public ?string $existingCvEn = null;

    public function mount(): void
    {
        $this->profile = Profile::firstOrNew();
        $this->summary_id = $this->profile->summary_id ?? '';
        $this->summary_en = $this->profile->summary_en ?? '';
        $this->existingPhoto = $this->profile->photo ?? null;
        $this->existingCvId = $this->profile->cv_id ?? null;
        $this->existingCvEn = $this->profile->cv_en ?? null;
    }

    protected function rules(): array
    {
        return [
            'summary_id' => ['required', 'string'],
            'summary_en' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'max:5120'],
            'cv_id' => ['nullable', 'mimes:pdf', 'max:10240'],
            'cv_en' => ['nullable', 'mimes:pdf', 'max:10240'],
        ];
    }

    protected function messages(): array
    {
        return [
            'summary_id.required' => 'Ringkasan (ID) wajib diisi.',
            'photo.image' => 'File foto harus berupa gambar.',
            'photo.max' => 'Ukuran foto maksimal 5MB.',
            'cv_id.mimes' => 'CV Indonesia harus berformat PDF.',
            'cv_id.max' => 'Ukuran CV maksimal 10MB.',
            'cv_en.mimes' => 'CV English harus berformat PDF.',
            'cv_en.max' => 'Ukuran CV maksimal 10MB.',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'summary_id' => $this->summary_id,
            'summary_en' => $this->summary_en ?: null,
        ];

        if ($this->photo) {
            if ($this->existingPhoto) {
                Storage::disk('public')->delete($this->existingPhoto);
            }
            $data['photo'] = $this->photo->store('profiles', 'public');
            $this->existingPhoto = $data['photo'];
            $this->photo = null;
        } elseif ($this->profile->photo && is_null($this->existingPhoto)) {
            Storage::disk('public')->delete($this->profile->photo);
            $data['photo'] = null;
        }

        if ($this->cv_id) {
            if ($this->existingCvId) {
                Storage::disk('public')->delete($this->existingCvId);
            }
            $data['cv_id'] = $this->cv_id->store('cvs', 'public');
            $this->existingCvId = $data['cv_id'];
            $this->cv_id = null;
        } elseif ($this->profile->cv_id && is_null($this->existingCvId)) {
            Storage::disk('public')->delete($this->profile->cv_id);
            $data['cv_id'] = null;
        }

        if ($this->cv_en) {
            if ($this->existingCvEn) {
                Storage::disk('public')->delete($this->existingCvEn);
            }
            $data['cv_en'] = $this->cv_en->store('cvs', 'public');
            $this->existingCvEn = $data['cv_en'];
            $this->cv_en = null;
        } elseif ($this->profile->cv_en && is_null($this->existingCvEn)) {
            Storage::disk('public')->delete($this->profile->cv_en);
            $data['cv_en'] = null;
        }

        $this->profile->fill($data)->save();

        $this->dispatch('notify', type: 'success', message: 'Profil berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.admin.profile-form');
    }
}
