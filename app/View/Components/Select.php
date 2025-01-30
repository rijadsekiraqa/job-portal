<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $id;
    public $class;
    public $placeholder;
    public $options;
    public $valueKey;
    public $textKey;

    public function __construct($name = null, $id = null, $class = null, $placeholder = null, $options = [], $valueKey = 'id', $textKey = 'name')
    {
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->placeholder = $placeholder;
        $this->options = $options;
        $this->valueKey = $valueKey;
        $this->textKey = $textKey;
    }

    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
