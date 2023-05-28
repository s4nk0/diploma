<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $queryString = ['search'];


    public function render()
    {
        $users = User::search($this->search)->orderBy('created_at','desc')->paginate(5);
        return view('livewire.admin.user.index',compact('users'));
    }
}
