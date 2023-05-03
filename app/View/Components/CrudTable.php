<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CrudTable extends Component
{
    public $header;
    public $header_button;
    public $pagination;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = null,$header_button = null,$pagination = null)
    {
        $this->header = $header;
        $this->header_button = $header_button;
        $this->pagination = $pagination;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.crud-table');
    }
}
