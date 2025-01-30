<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    /**
     * Create a new component instance.
     */
    public $href;
    public $class;
    public $label;

    public function __construct($href = null, $class = null, $label = null)
    {
        $this->href = $href;
        $this->class = $class;
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link');
    }
}
