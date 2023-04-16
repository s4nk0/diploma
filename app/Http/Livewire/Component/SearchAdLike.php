<?php

namespace App\Http\Livewire\Component;

use App\Models\Ad;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchAdLike extends Component
{
    public $ad;
    protected $listeners = ['search-ad-like-refresh' => '$refresh'];
    public $style;
    public function mount($ad,$style=null){
        $this->ad=$ad;
        $this->style =$style;
    }

    public function like(){
        if (Auth::check()){
            $this->ad->liked_users()->toggle(Auth::user());
        } else {
            return redirect()->route('login');
        }
        $this->emit('search-ad-like-refresh');
    }

    public function render()
    {
        return view('livewire.component.search-ad-like');
    }
}
