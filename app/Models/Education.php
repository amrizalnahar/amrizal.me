<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasLocalizable;

    protected $table = 'educations';

    protected $fillable = [
        'institution_name', 'logo', 'degree',
        'major_id', 'major_en',
        'started_at', 'ended_at', 'sort_order',
    ];

    protected $casts = [
        'started_at' => 'integer',
        'ended_at' => 'integer',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('started_at', 'desc');
    }
}
