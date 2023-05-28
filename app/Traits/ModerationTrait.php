<?php

namespace App\Traits;

use App\Models\Scopes\ModerationScope;
use Illuminate\Database\Eloquent\SoftDeletingScope;

trait ModerationTrait
{
    public function scopeModeration($query)
    {
        return $query->where('status_moderation_id', 1);
    }

    public static function bootModerationTrait()
    {
        static::addGlobalScope(new ModerationScope());
    }
}
