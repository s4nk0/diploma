<?php

namespace App\Http\Livewire\Component;

use App\Models\AdGet;
use Livewire\Component;

class GetAdView extends Component
{

    public $ad_get;
    public $take = 8;
    public $skip = 8;
    public $hide = false;

    public function mount(){
        $this->ad_get = AdGet::skip(0)->take($this->take)->get();
    }

    public function showMore(){
        $ad_get = AdGet::skip($this->skip)->take($this->take)->get();
        $this->ad_get = $this->ad_get->merge($ad_get);

        if ($ad_get->count()){
            $this->skip = $this->skip + $this->take;
        } else{
            $this->hideButton();
        }
    }

    public function hideButton(){
        $this->hide = true;
    }

    public function render()
    {
        return view('livewire.component.get-ad-view');
    }
}
