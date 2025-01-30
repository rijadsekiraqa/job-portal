<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $class;
    public $placeholder;
    public $rows;
    public $cols;
    public $id;
    public $value;
    public $readonly;

    /**
     * Create a new component instance.
     */
    public function __construct($name = null, $class = null, $placeholder = null, $rows = null, $cols = null, $id = null, $value = null, $readonly = null)
    {
        $this->name = $name;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->cols = $cols;
        $this->id = $id;
        $this->value = $value;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.textarea');
    }
}
