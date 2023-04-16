<?php

namespace App\Http\Livewire\Component;

use App\Enums\CookieNames;
use App\Models\City;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class CityCookie extends Component
{
    public $city;
    protected $listeners = ['city-cookie-refresh' => '$refresh'];

    public function render()
    {
        $this->city = (@$_COOKIE[CookieNames::SelectedCity->value]) ? City::find($_COOKIE[CookieNames::SelectedCity->value]) : City::find(1);


        return view('livewire.component.city-cookie');
    }
}
