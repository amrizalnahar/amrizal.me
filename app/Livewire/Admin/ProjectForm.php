<?php

namespace App\Livewire\Admin;

use App\Models\Project;
use App\Models\ProjectTechnology;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class ProjectForm extends Component
{
    use WithFileUploads;

    public ?Project $project = null;

    public string $title_id = '';
    public string $title_en = '';
    public string $type = '';
    public string $company_name = '';
    public string $short_description_id = '';
    public string $short_description_en = '';
    public string $full_description_id = '';
    public string $full_description_en = '';
    public string $role = '';
    public string $period = '';
    public string $demo_url = '';
    public string $repo_url = '';
    public $thumbnail = null;
    public ?string $existingThumbnail = null;
    public array $technologies = [];
    public string $newTechnology = '';
    public string $status = 'draft';
    public int $sort_order = 0;

    public function mount(?Project $project = null): void
    {
        $this->project = $project;

        if ($project) {
            $this->title_id = $project->title_id;
            $this->title_en = $project->title_en ?? '';
            $this->type = $project->type;
            $this->company_name = $project->company_name ?? '';
            $this->short_description_id = $project->short_description_id ?? '';
            $this->short_description_en = $project->short_description_en ?? '';
            $this->full_description_id = $project->full_description_id ?? '';
            $this->full_description_en = $project->full_description_en ?? '';
            $this->role = $project->role ?? '';
            $this->period = $project->period ?? '';
            $this->demo_url = $project->demo_url ?? '';
            $this->repo_url = $project->repo_url ?? '';
            $this->existingThumbnail = $project->thumbnail;
            $this->technologies = $project->technologies->pluck('technology_name')->toArray();
            $this->status = $project->status;
            $this->sort_order = $project->sort_order ?? 0;
        }
    }

    protected function rules(): array
    {
        return [
            'title_id' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'short_description_id' => ['required', 'string'],
            'short_description_en' => ['nullable', 'string'],
            'full_description_id' => ['nullable', 'string'],
            'full_description_en' => ['nullable', 'string'],
            'role' => ['nullable', 'string', 'max:255'],
            'period' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'thumbnail' => [
                'nullable',
                'image',
                'max:2048',
            ],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:255'],
            'status' => ['required', 'in:draft,publish'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title_id.required' => 'Judul (ID) wajib diisi.',
            'type.required' => 'Tipe proyek wajib diisi.',
            'short_description_id.required' => 'Deskripsi singkat wajib diisi.',
            'status.required' => 'Status wajib dipilih.',
            'sort_order.required' => 'Urutan wajib diisi.',
            'thumbnail.image' => 'File harus berupa gambar.',
            'thumbnail.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    public function addTechnology(): void
    {
        $this->validate([
            'newTechnology' => ['required', 'string', 'max:255'],
        ], [
            'newTechnology.required' => 'Nama teknologi wajib diisi.',
        ]);

        $tech = trim($this->newTechnology);

        if (in_array($tech, $this->technologies)) {
            $this->dispatch('notify', type: 'error', message: 'Teknologi "' . $tech . '" sudah ada.');
            $this->newTechnology = '';
            return;
        }

        $this->technologies[] = $tech;
        $this->newTechnology = '';
    }

    public function removeTechnology(int $index): void
    {
        unset($this->technologies[$index]);
        $this->technologies = array_values($this->technologies);
    }

    public function save(): void
    {
        $this->validate();

        $thumbnailPath = $this->existingThumbnail;

        if ($this->thumbnail) {
            if ($this->existingThumbnail) {
                Storage::disk('public')->delete($this->existingThumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('projects', 'public');
        }

        $project = Project::updateOrCreate(
            ['id' => $this->project?->id],
            [
                'title_id' => $this->title_id,
                'title_en' => $this->title_en ?: null,
                'type' => $this->type,
                'company_name' => $this->company_name ?: null,
                'short_description_id' => $this->short_description_id,
                'short_description_en' => $this->short_description_en ?: null,
                'full_description_id' => $this->full_description_id ?: null,
                'full_description_en' => $this->full_description_en ?: null,
                'role' => $this->role ?: null,
                'period' => $this->period ?: null,
                'demo_url' => $this->demo_url ?: null,
                'repo_url' => $this->repo_url ?: null,
                'thumbnail' => $thumbnailPath,
                'status' => $this->status,
                'sort_order' => $this->sort_order,
            ]
        );

        $project->technologies()->delete();
        foreach ($this->technologies as $tech) {
            $project->technologies()->create(['technology_name' => $tech]);
        }

        $this->dispatch('notify', type: 'success', message: $this->project ? 'Proyek berhasil diperbarui.' : 'Proyek berhasil ditambahkan.');
        $this->redirectRoute('admin.projects');
    }

    public function render()
    {
        return view('livewire.admin.project-form');
    }
}
