<?php

namespace App\Models\Traits;

trait UserId
{
    public static function bootUserId()
    {
        static::creating(function ($model) {
            $model->user_id = $model->user_id ?? auth()->id();
        });
    }

    public function scopeUserId($query, $userId = null)
    {
        return $query->where('user_id', $userId ?? auth()->id());
    }
}
