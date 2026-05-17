<?php

namespace App\Livewire\Admin;

use App\Models\Skill;
use App\Models\SkillCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class SkillCategoryManager extends Component
{
    // Category form fields
    public ?int $editingCategoryId = null;

    public string $categoryNameId = '';

    public string $categoryNameEn = '';

    public int $categorySortOrder = 0;

    // Skill form fields
    public ?int $editingSkillId = null;

    public ?int $skillCategoryId = null;

    public string $skillNameId = '';

    public string $skillNameEn = '';

    // Delete state
    public ?int $confirmingCategoryDelete = null;

    public ?int $confirmingSkillDelete = null;

    public function mount(): void
    {
        // nothing needed
    }

    // ─── Category Methods ───────────────────────────────────────────

    public function openCategoryModal(): void
    {
        $this->resetCategoryForm();
        $this->dispatch('open-modal', 'category-modal');
    }

    public function closeCategoryModal(): void
    {
        $this->dispatch('close-modal', 'category-modal');
        $this->resetCategoryForm();
    }

    public function resetCategoryForm(): void
    {
        $this->editingCategoryId = null;
        $this->categoryNameId = '';
        $this->categoryNameEn = '';
        $this->categorySortOrder = 0;
        $this->confirmingCategoryDelete = null;
        $this->resetValidation();
    }

    public function saveCategory(): void
    {
        $this->validate(
            [
                'categoryNameId' => ['required', 'string', 'max:255'],
                'categoryNameEn' => ['nullable', 'string', 'max:255'],
                'categorySortOrder' => ['required', 'integer', 'min:0'],
            ],
            [
                'categoryNameId.required' => 'Nama kategori (ID) wajib diisi.',
                'categorySortOrder.required' => 'Urutan wajib diisi.',
            ]
        );

        SkillCategory::updateOrCreate(
            ['id' => $this->editingCategoryId],
            [
                'name_id' => $this->categoryNameId,
                'name_en' => $this->categoryNameEn ?: null,
                'sort_order' => $this->categorySortOrder,
            ]
        );

        $this->closeCategoryModal();
        $this->dispatch('notify', type: 'success', message: 'Kategori berhasil disimpan.');
    }

    public function editCategory(int $id): void
    {
        $category = SkillCategory::findOrFail($id);
        $this->editingCategoryId = $category->id;
        $this->categoryNameId = $category->name_id;
        $this->categoryNameEn = $category->name_en ?? '';
        $this->categorySortOrder = $category->sort_order;
        $this->dispatch('open-modal', 'category-modal');
    }

    public function confirmCategoryDelete(int $id): void
    {
        $this->confirmingCategoryDelete = $id;
    }

    public function deleteCategory(): void
    {
        if (! $this->confirmingCategoryDelete) {
            return;
        }

        $category = SkillCategory::findOrFail($this->confirmingCategoryDelete);

        // Delete related skills first
        $category->skills()->delete();
        $category->delete();

        $this->confirmingCategoryDelete = null;
        $this->dispatch('notify', type: 'success', message: 'Kategori berhasil dihapus.');
    }

    // ─── Skill Methods ──────────────────────────────────────────────

    public function openSkillModal(int $categoryId): void
    {
        $this->resetSkillForm();
        $this->skillCategoryId = $categoryId;
        $this->dispatch('open-modal', 'skill-modal');
    }

    public function closeSkillModal(): void
    {
        $this->dispatch('close-modal', 'skill-modal');
        $this->resetSkillForm();
    }

    public function resetSkillForm(): void
    {
        $this->editingSkillId = null;
        $this->skillCategoryId = null;
        $this->skillNameId = '';
        $this->skillNameEn = '';
        $this->confirmingSkillDelete = null;
        $this->resetValidation();
    }

    public function saveSkill(): void
    {
        $this->validate(
            [
                'skillCategoryId' => ['required', 'exists:skill_categories,id'],
                'skillNameId' => ['required', 'string', 'max:255'],
                'skillNameEn' => ['nullable', 'string', 'max:255'],
            ],
            [
                'skillCategoryId.required' => 'Kategori wajib dipilih.',
                'skillNameId.required' => 'Nama skill (ID) wajib diisi.',
            ]
        );

        Skill::updateOrCreate(
            ['id' => $this->editingSkillId],
            [
                'skill_category_id' => $this->skillCategoryId,
                'name_id' => $this->skillNameId,
                'name_en' => $this->skillNameEn ?: null,
            ]
        );

        $this->closeSkillModal();
        $this->dispatch('notify', type: 'success', message: 'Skill berhasil disimpan.');
    }

    public function editSkill(int $id): void
    {
        $skill = Skill::findOrFail($id);
        $this->editingSkillId = $skill->id;
        $this->skillCategoryId = $skill->skill_category_id;
        $this->skillNameId = $skill->name_id;
        $this->skillNameEn = $skill->name_en ?? '';
        $this->dispatch('open-modal', 'skill-modal');
    }

    public function confirmSkillDelete(int $id): void
    {
        $this->confirmingSkillDelete = $id;
    }

    public function deleteSkill(): void
    {
        if (! $this->confirmingSkillDelete) {
            return;
        }

        Skill::findOrFail($this->confirmingSkillDelete)->delete();

        $this->confirmingSkillDelete = null;
        $this->dispatch('notify', type: 'success', message: 'Skill berhasil dihapus.');
    }

    public function render()
    {
        $categories = SkillCategory::ordered()->with('skills')->get();

        return view('livewire.admin.skill-category-manager', [
            'categories' => $categories,
        ]);
    }
}
