<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // This tells Laravel: "Look for the file in resources/views/layouts/admin.blade.php"
        return view('layouts.admin');
    }
}