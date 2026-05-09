<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected function getSlugSource(): ?string
    {
        if (method_exists($this, 'getSlugSourceAttribute')) {
            return $this->getSlugSourceAttribute();
        }

        return $this->title ?? null;
    }

    protected function getSlugSourceField(): string
    {
        return method_exists($this, 'getSlugSourceAttribute') ? 'title_id' : 'title';
    }

    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            $source = $model->getSlugSource();
            if (empty($model->slug) && ! empty($source)) {
                $model->slug = $model->generateUniqueSlug($source);
            }
        });

        static::updating(function ($model) {
            $source = $model->getSlugSource();
            if ($model->isDirty($model->getSlugSourceField()) && empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($source);
            }
        });
    }

    public function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (
            static::where('slug', $slug)
                ->where('id', '!=', $this->id ?? 0)
                ->whereNull('deleted_at')
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}