<?php

namespace App\Http\Livewire\Modal;

use App\Enums\CookieNames;
use App\Models\City;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class CityCheckQuestion extends ModalComponent
{
    public $city;

    public function mount(){
        $this->city = City::find(1);

    }

    public function yes(){
        setcookie(CookieNames::SelectedCity->value,$this->city->id, time() + 3600*24*365, "/");

        $this->emit('city-cookie-refresh');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.modal.city-check-question');
    }
}
