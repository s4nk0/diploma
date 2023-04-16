<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface AdSearchRepository{
    public function search(string $query,$filters): Collection;
}
