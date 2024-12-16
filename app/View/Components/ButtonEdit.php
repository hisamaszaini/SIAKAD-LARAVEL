<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonEdit extends Component
{
    /**
     * Create a new component instance.
     */
    public $link;

    public function __construct($link)
    {
        $this->link = $link; // Menyimpan link ke properti
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button-edit');
    }
}
