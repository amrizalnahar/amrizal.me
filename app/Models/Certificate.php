<?php

namespace App\Models;

use App\Traits\HasLocalizable;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasLocalizable;

    protected $fillable = [
        'title_id', 'title_en',
        'issuer_name', 'issuer_logo',
        'description_id', 'description_en',
        'issued_at', 'expired_at',
        'verify_url', 'certificate_image',
        'status', 'sort_order',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expired_at' => 'date',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('issued_at', 'desc');
    }
}
