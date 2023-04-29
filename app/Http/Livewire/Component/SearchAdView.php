<?php

namespace App\Http\Livewire\Component;

use App\Enums\CookieNames;
use App\Models\Ad;
use Illuminate\Support\Carbon;
use Livewire\Component;

class SearchAdView extends Component
{
    public $take = 8;
    public $skip = 8;
    public $ad;
    public $hide = false;



    public function mount(){
        $this->ad = Ad::where('city_id',( @$_COOKIE[CookieNames::SelectedCity->value]) ? $_COOKIE[CookieNames::SelectedCity->value] : 1)->orderBy('created_at','desc')->union(
            Ad::where('city_id', '!=', ( @$_COOKIE[CookieNames::SelectedCity->value]) ? $_COOKIE[CookieNames::SelectedCity->value] : 1)->orderBy('created_at','desc')
        )->skip(0)->take($this->take)->get();



    }

    public function showMore(){
        $ad = Ad::where('city_id', $_COOKIE[CookieNames::SelectedCity->value])->orderBy('created_at','desc')->union(
            Ad::where('city_id', '!=', $_COOKIE[CookieNames::SelectedCity->value])->orderBy('created_at','desc')
        )->skip($this->skip)->take($this->take)->get();


        $this->ad = $this->ad->merge($ad);

        if ($ad->count()){
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
        return view('livewire.component.search-ad-view');
    }
}
