<?php

namespace App\Models;

use App\Helpers\SeoHelper;
use App\Traits\HasLocalizable;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasLocalizable, HasSlug, SoftDeletes;

    protected $fillable = [
        'title_id', 'title_en', 'slug',
        'type', 'company_name',
        'short_description_id', 'short_description_en',
        'full_description_id', 'full_description_en',
        'role', 'period',
        'demo_url', 'repo_url',
        'thumbnail', 'gallery',
        'status', 'sort_order',
        'views',
        'meta_title', 'meta_description', 'meta_keywords',
    ];

    protected $casts = [
        'gallery' => 'array',
        'status' => 'string',
    ];

    public function technologies(): HasMany
    {
        return $this->hasMany(ProjectTechnology::class);
    }

    public function members(): HasMany
    {
        return $this->hasMany(ProjectMember::class)->orderBy('sort_order', 'asc');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    public function getSlugSourceAttribute(): string
    {
        return $this->title_id;
    }

    /**
     * Resolved SEO title dengan fallback ke title.
     */
    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?? $this->localize('title');
    }

    /**
     * Resolved SEO description dengan fallback ke short description.
     */
    public function getSeoDescriptionAttribute(): string
    {
        if ($this->meta_description) {
            return $this->meta_description;
        }

        return SeoHelper::metaDescription($this->localize('short_description'));
    }

    /**
     * Resolved SEO keywords dengan fallback ke technologies + type.
     */
    public function getSeoKeywordsAttribute(): string
    {
        if ($this->meta_keywords) {
            return $this->meta_keywords;
        }

        return SeoHelper::keywords($this->technologies->pluck('technology_name')->toArray(), $this->type);
    }
}
