<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ProfileCheck extends ModalComponent
{
    public function render()
    {
        return view('livewire.modal.profile-check');
    }
}
