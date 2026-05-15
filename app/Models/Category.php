<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, HasLocalizable, SoftDeletes;

    protected $fillable = [
        'module_type',
        'name',
        'name_id',
        'name_en',
        'slug',
        'description',
    ];

    protected $casts = [
        'module_type' => 'string',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function scopeByModule($query, string $module)
    {
        return $query->where('module_type', $module);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
                ->orWhere('name_id', 'like', "%{$term}%")
                ->orWhere('name_en', 'like', "%{$term}%")
                ->orWhere('slug', 'like', "%{$term}%");
        });
    }
}
