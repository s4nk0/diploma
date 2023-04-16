<?php

namespace App\Repositories;

use App\Interfaces\AdGetSearchRepository;
use App\Models\Ad;
use App\Models\AdGet;
use Illuminate\Database\Eloquent\Collection;

class EloquentSearchAdGetRepository implements AdGetSearchRepository {
    public function search(string $term,$filters = null): Collection
    {
        return AdGet::query()
            ->where(fn ($query) => (
            $query->where('location', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%")
            ))
            ->get();
    }
}
