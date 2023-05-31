<?php

namespace App\Traits;

use App\Models\Scopes\ModerationScope;
use Illuminate\Database\Eloquent\SoftDeletingScope;

trait ModerationTrait
{
    public static function bootModerationTrait()
    {
        static::addGlobalScope(new ModerationScope());
    }
}
