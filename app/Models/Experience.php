<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'company_name', 'logo', 'position',
        'description_id', 'description_en',
        'started_at', 'ended_at', 'is_current', 'sort_order',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
        'is_current' => 'boolean',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('started_at', 'desc');
    }
}
