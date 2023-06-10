<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public $topheader;
    public $header;
    public $footer;
    public function __construct($topheader = true, $header = true, $footer = true)
    {
        $this->footer = $footer;
        $this->header = $header;
        $this->topheader = $topheader;
    }
    public function render(): View
    {
        return view('layouts.guest');
    }
}
