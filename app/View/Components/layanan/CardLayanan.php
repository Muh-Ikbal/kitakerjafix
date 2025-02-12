<?php

namespace App\View\Components\layanan;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardLayanan extends Component
{
    /**
     * Create a new component instance.
     */
    public $services;
    public function __construct($services)
    {
        $this->services = $services;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layanan.card-layanan');
    }
}
