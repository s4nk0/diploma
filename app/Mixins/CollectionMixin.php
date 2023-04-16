<?php

namespace App\Mixins;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CollectionMixin
{
    public function paginate(){
        //добавление пагинации на коллекцию
        return function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $total ? $this : $this->forPage($page, $perPage)->values(),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        };
    }

    public function withModel(){
        //добавление пагинации на коллекцию
        return function () {
            return $this->map(function ($items) {

                $items['class'] = get_class($items);
                return $items;
            });
        };
    }

    public function modelsByQuantity(){
        return function(){
            return $this->groupBy('id')->map(function ($items) {
                $quantity = $items->count();
                $items = $items->first();
                $items['quantity'] = $quantity;
                return $items;
            });
        };
    }
}
