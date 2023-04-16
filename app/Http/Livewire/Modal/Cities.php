<?php

namespace App\Http\Livewire\Modal;

use App\Enums\CookieNames;
use App\Models\City;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Cities extends ModalComponent
{
    public $cities;

    protected $listeners = ['city-select' => 'select_city'];

    public function mount(){
        $this->cities = City::all();
    }

    public function select_city($id){
        setcookie(CookieNames::SelectedCity->value,$id, time() + 3600*24*365, "/");

        $this->emit('city-cookie-refresh');
        $this->forceClose()->closeModal();
    }

    public function render()
    {
        return view('livewire.modal.cities');
    }
}
