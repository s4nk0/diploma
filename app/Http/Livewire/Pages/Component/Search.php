<?php

namespace App\Http\Livewire\Pages\Component;

use App\Interfaces\AdGetSearchRepository;
use App\Interfaces\AdSearchRepository;
use App\Models\Ad;
use App\Models\AdGet;
use Livewire\Component;

class Search extends Component
{
    public $search;
    public $search_ad;
    public $get_ad;
    public $result;

    protected $queryString = ['search'];

    protected $searchAdRepository;
    protected $searchAdGetRepository;

    public function boot(AdSearchRepository $searchAdRepository,AdGetSearchRepository $adGetSearchRepository){
        $this->searchAdRepository = $searchAdRepository;
        $this->searchAdGetRepository = $adGetSearchRepository;
    }

    public function updatedSearch(){
        $this->search_ad = collect($this->searchAdRepository->search($this->search));
        $this->get_ad = collect($this->searchAdGetRepository->search($this->search));

        $this->result = $this->search_ad->merge($this->get_ad)->take(5);

    }

    public function search(){
        return redirect()->route('search',['search'=>$this->search]);
    }

    public function render()
    {
        return view('livewire.pages.component.search');
    }
}
