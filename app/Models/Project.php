<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
