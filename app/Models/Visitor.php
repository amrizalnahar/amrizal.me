<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address', 'user_agent', 'page_url',
        'referer', 'session_id', 'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    public static function countUnique(?int $days = null): int
    {
        $query = static::query();
        if ($days) {
            $query->where('visited_at', '>=', now()->subDays($days));
        }

        return $query->distinct('ip_address')->count('ip_address');
    }
}
