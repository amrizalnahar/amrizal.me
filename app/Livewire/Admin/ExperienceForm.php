<?php

namespace App\Livewire\Admin;

use App\Models\Experience;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class ExperienceForm extends Component
{
    use WithFileUploads;

    public ?Experience $experience = null;

    public string $company_name = '';

    public string $position = '';

    public string $description_id = '';

    public ?string $description_en = '';

    public $logo = null;

    public ?string $existingLogo = null;

    public ?string $started_at = '';

    public ?string $ended_at = '';

    public bool $is_current = false;

    public int $sort_order = 0;

    public function mount(?Experience $experience = null): void
    {
        $this->experience = $experience;

        if ($experience) {
            $this->company_name = $experience->company_name;
            $this->position = $experience->position;
            $this->description_id = $experience->description_id;
            $this->description_en = $experience->description_en ?? '';
            $this->existingLogo = $experience->logo;
            $this->started_at = $experience->started_at?->format('Y-m-d');
            $this->ended_at = $experience->ended_at?->format('Y-m-d');
            $this->is_current = $experience->is_current;
            $this->sort_order = $experience->sort_order;
        }
    }

    protected function rules(): array
    {
        return [
            'company_name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'description_id' => ['required', 'string'],
            'description_en' => ['nullable', 'string'],
            'logo' => [
                'nullable',
                'image',
                'max:2048',
                'mimes:jpg,jpeg,png,webp',
            ],
            'started_at' => ['required', 'date'],
            'ended_at' => [
                'nullable',
                'date',
                'after_or_equal:started_at',
            ],
            'is_current' => ['boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function messages(): array
    {
        return [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'position.required' => 'Posisi wajib diisi.',
            'description_id.required' => 'Deskripsi wajib diisi.',
            'started_at.required' => 'Tanggal mulai wajib diisi.',
            'ended_at.after_or_equal' => 'Tanggal selesai harus setelah tanggal mulai.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'logo.image' => 'File harus berupa gambar.',
            'logo.max' => 'Ukuran gambar maksimal 2MB.',
            'logo.mimes' => 'Gambar harus berformat jpg, png, atau webp.',
        ];
    }

    public function updatedIsCurrent(): void
    {
        if ($this->is_current) {
            $this->ended_at = null;
        }
    }

    public function save(): void
    {
        $data = $this->validate();

        $logoPath = $this->existingLogo;

        $disk = config('filesystems.default');

        if ($this->logo) {
            if ($this->existingLogo) {
                Storage::disk($disk)->delete($this->existingLogo);
            }
            $logoPath = $this->logo->store('experiences', $disk);
        }

        Experience::updateOrCreate(
            ['id' => $this->experience?->id],
            [
                'company_name' => $this->company_name,
                'position' => $this->position,
                'description_id' => $this->description_id,
                'description_en' => $this->description_en ?: null,
                'logo' => $logoPath,
                'started_at' => $this->started_at,
                'ended_at' => $this->is_current ? null : $this->ended_at,
                'is_current' => $this->is_current,
                'sort_order' => $this->sort_order,
            ]
        );

        $this->dispatch('notify', type: 'success', message: 'Pengalaman kerja berhasil disimpan.');
        $this->redirectRoute('admin.experiences');
    }

    public function render()
    {
        return view('livewire.admin.experience-form');
    }
}
