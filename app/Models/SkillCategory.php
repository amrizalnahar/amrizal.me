<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillCategory extends Model
{
    use HasLocalizable;

    protected $fillable = ['name_id', 'name_en', 'sort_order'];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }
}
