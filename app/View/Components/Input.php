<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;



class Input extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $id;
    public $class;
    public $type;
    public $value;

    public function __construct($name = null, $label = null, $placeholder = null, $id = null, $class = null, $type = null, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->id = $id;
        $this->class = $class;
        $this->type = $type;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.input');
    }
}
