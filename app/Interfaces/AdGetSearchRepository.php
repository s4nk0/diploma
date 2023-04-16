<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface AdGetSearchRepository {
    public function search(string $query): Collection;
}
