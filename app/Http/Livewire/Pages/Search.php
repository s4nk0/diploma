<?php

namespace App\Http\Livewire\Pages;

use App\Interfaces\AdGetSearchRepository;
use App\Interfaces\AdSearchRepository;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    protected $adSearchRepository;
    protected $adGetSearchRepository;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh-page-search' => '$refresh'];

    public $query;
    public $price_from;
    public $price_to;
    public $search_ad;
    public $get_ad;
    public $result_all;
    public $result_count;

    public function boot(AdSearchRepository $adSearchRepository, AdGetSearchRepository $adGetSearchRepository){
        $this->adSearchRepository = $adSearchRepository;
        $this->adGetSearchRepository = $adGetSearchRepository;
    }

    public function mount($search = '')
    {
        $this->query = $search;
        $this->search_ad = collect($this->adSearchRepository->search($this->query));
        $this->get_ad = collect($this->adGetSearchRepository->search($this->query));
        $this->result_all = $this->search_ad->merge($this->get_ad);
        $this->result_all = $this->result_all->withModel();
        $this->result_count = $this->result_all->count();
    }

    public function updatedPriceFrom(){

        $this->result_all =  $this->result_all->where('price','>=',$this->price_from);

    }

    public function render()
    {
        $result = $this->result_all->paginate(5);

        return view('livewire.pages.search', compact('result'))->layout('layouts.app');
    }
}
