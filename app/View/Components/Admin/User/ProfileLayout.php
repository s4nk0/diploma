<?php

namespace App\View\Components\Admin\User;

use App\Models\User;
use Illuminate\View\Component;

class ProfileLayout extends Component
{

    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.admin.user.profile');
    }
}
