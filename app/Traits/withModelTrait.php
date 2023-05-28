<?php

namespace App\Traits;

trait withModelTrait
{
    public function initializeWithModelTrait()
    {
        $this->append('model');
    }

    public function getModelAttribute()
    {
        return get_class($this);
    }
}
