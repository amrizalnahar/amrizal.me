<?php

namespace App\Livewire\Admin;

use App\Models\Project;
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

    public string $period = '';

    public string $role = '';

    public string $demo_url = '';

    public string $repo_url = '';

    public $thumbnail = null;

    public ?string $existingThumbnail = null;

    public array $technologies = [];

    public string $newTechnology = '';

    public array $members = [];

    public string $newMemberName = '';

    public string $newMemberRole = '';

    public string $status = 'draft';

    public int $sort_order = 0;

    public string $meta_title = '';

    public string $meta_description = '';

    public string $meta_keywords = '';

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
            $this->period = $project->period ?? '';
            $this->role = $project->role ?? '';
            $this->demo_url = $project->demo_url ?? '';
            $this->repo_url = $project->repo_url ?? '';
            $this->existingThumbnail = $project->thumbnail;
            $this->technologies = $project->technologies->pluck('technology_name')->toArray();
            $this->members = $project->members->map(fn ($m) => ['name' => $m->name, 'role' => $m->role, 'sort_order' => $m->sort_order])->toArray();
            $this->status = $project->status;
            $this->sort_order = $project->sort_order ?? 0;
            $this->meta_title = $project->meta_title ?? '';
            $this->meta_description = $project->meta_description ?? '';
            $this->meta_keywords = $project->meta_keywords ?? '';
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
            'period' => ['nullable', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'repo_url' => ['nullable', 'url', 'max:255'],
            'thumbnail' => [
                'nullable',
                'image',
                'max:2048',
            ],
            'technologies' => ['nullable', 'array'],
            'technologies.*' => ['string', 'max:255'],
            'members' => ['nullable', 'array'],
            'members.*.name' => ['required', 'string', 'max:255'],
            'members.*.role' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,publish'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
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
            $this->dispatch('notify', type: 'error', message: 'Teknologi "'.$tech.'" sudah ada.');
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

    public function addMember(): void
    {
        $this->validate([
            'newMemberName' => ['required', 'string', 'max:255'],
            'newMemberRole' => ['nullable', 'string', 'max:255'],
        ], [
            'newMemberName.required' => 'Nama anggota wajib diisi.',
        ]);

        $this->members[] = [
            'name' => trim($this->newMemberName),
            'role' => trim($this->newMemberRole) ?: null,
            'sort_order' => count($this->members),
        ];

        $this->newMemberName = '';
        $this->newMemberRole = '';
    }

    public function removeMember(int $index): void
    {
        unset($this->members[$index]);
        $this->members = array_values($this->members);
    }

    public function save(): void
    {
        $this->validate();

        $thumbnailPath = $this->existingThumbnail;

        $disk = env('STORAGE_DISK', 's3');

        if ($this->thumbnail) {
            if ($this->existingThumbnail) {
                Storage::disk($disk)->delete($this->existingThumbnail);
            }
            $thumbnailPath = $this->thumbnail->store('projects', $disk);
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
                'period' => $this->period,
                'role' => $this->role,
                'demo_url' => $this->demo_url ?: null,
                'repo_url' => $this->repo_url ?: null,
                'thumbnail' => $thumbnailPath,
                'status' => $this->status,
                'sort_order' => $this->sort_order,
                'meta_title' => $this->meta_title ?: null,
                'meta_description' => $this->meta_description ?: null,
                'meta_keywords' => $this->meta_keywords ?: null,
            ]
        );

        $project->technologies()->delete();
        foreach ($this->technologies as $tech) {
            $project->technologies()->create(['technology_name' => $tech]);
        }

        $project->members()->delete();
        foreach ($this->members as $index => $member) {
            $project->members()->create([
                'name' => $member['name'],
                'role' => $member['role'] ?? null,
                'sort_order' => $member['sort_order'] ?? $index,
            ]);
        }

        $this->dispatch('notify', type: 'success', message: 'Proyek berhasil disimpan.');
        $this->redirectRoute('admin.projects.show', ['project' => $project->id]);
    }

    public function render()
    {
        return view('livewire.admin.project-form');
    }
}
