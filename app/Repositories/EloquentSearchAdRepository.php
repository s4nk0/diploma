<?php

namespace App\Repositories;

use App\Interfaces\AdSearchRepository;
use App\Interfaces\SearchRepository;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Collection;

class EloquentSearchAdRepository implements AdSearchRepository
{
    public function search(string $term, $filters =null): Collection
    {
        return Ad::query()
            ->where(fn ($query) => (
            $query->where('location', 'LIKE', "%{$term}%")
                ->orWhere('description', 'LIKE', "%{$term}%")
            ))
            ->get();
    }
}
