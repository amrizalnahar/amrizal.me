<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'summary_id', 'summary_en',
        'cv_id', 'cv_en',
        'photo',
    ];

    public static function getProfile(): ?self
    {
        return static::first();
    }
}
