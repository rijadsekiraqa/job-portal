<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public $type;
    public $class;
    public $label;
    public $id;
    public $style;

    public function __construct($type = null, $class = null, $label = null, $id = null, $style = null)
    {
        $this->type = $type;
        $this->class = $class;
        $this->label = $label;
        $this->id = $id;
        $this->style = $style;
    }

    public function render()
    {
        return view('components.button');
    }
}
