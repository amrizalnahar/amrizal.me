<?php

namespace App\Livewire\Admin;

use App\Models\Education;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class EducationForm extends Component
{
    use WithFileUploads;

    public ?Education $education = null;

    public string $institution_name = '';

    public string $degree = '';

    public string $major_id = '';

    public ?string $major_en = '';

    public $logo = null;

    public ?string $existingLogo = null;

    public ?int $started_at = null;

    public ?int $ended_at = null;

    public int $sort_order = 0;

    public function mount(?Education $education = null): void
    {
        $this->education = $education;

        if ($education) {
            $this->institution_name = $education->institution_name;
            $this->degree = $education->degree;
            $this->major_id = $education->major_id;
            $this->major_en = $education->major_en ?? '';
            $this->existingLogo = $education->logo;
            $this->started_at = $education->started_at;
            $this->ended_at = $education->ended_at;
            $this->sort_order = $education->sort_order;
        }
    }

    protected function rules(): array
    {
        return [
            'institution_name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'major_id' => ['required', 'string'],
            'major_en' => ['nullable', 'string'],
            'logo' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpg,jpeg,png,webp',
            ],
            'started_at' => ['required', 'integer', 'min:1950', 'max:2050'],
            'ended_at' => [
                'nullable',
                'integer',
                'min:1950',
                'max:2050',
                'gte:started_at',
            ],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function messages(): array
    {
        return [
            'institution_name.required' => 'Nama institusi wajib diisi.',
            'degree.required' => 'Gelar wajib diisi.',
            'major_id.required' => 'Jurusan wajib diisi.',
            'started_at.required' => 'Tahun mulai wajib diisi.',
            'ended_at.gte' => 'Tahun selesai harus setelah atau sama dengan tahun mulai.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'logo.image' => 'File harus berupa gambar.',
            'logo.max' => 'Ukuran gambar maksimal 2MB.',
            'logo.mimes' => 'Gambar harus berformat jpg, png, atau webp.',
        ];
    }

    public function save(): void
    {
        $data = $this->validate();

        $logoPath = $this->existingLogo;

        if ($this->logo) {
            if ($this->existingLogo) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $logoPath = $this->logo->store('educations', 'public');
        }

        Education::updateOrCreate(
            ['id' => $this->education?->id],
            [
                'institution_name' => $this->institution_name,
                'degree' => $this->degree,
                'major_id' => $this->major_id,
                'major_en' => $this->major_en ?: null,
                'logo' => $logoPath,
                'started_at' => $this->started_at,
                'ended_at' => $this->ended_at,
                'sort_order' => $this->sort_order,
            ]
        );

        $this->dispatch('notify', type: 'success', message: $this->education ? 'Pendidikan berhasil diperbarui.' : 'Pendidikan berhasil ditambahkan.');
        $this->redirectRoute('admin.educations');
    }

    public function render()
    {
        return view('livewire.admin.education-form');
    }
}
