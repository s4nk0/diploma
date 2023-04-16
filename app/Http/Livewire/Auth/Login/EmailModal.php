<?php

namespace App\Http\Livewire\Auth\Login;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EmailModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.auth.login.email-modal');
    }
}
