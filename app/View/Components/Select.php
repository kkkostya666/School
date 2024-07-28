<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $id;

    public $name;

    public $label;

    public $options;

    public $selected;

    public function __construct($id, $name, $label, $options = [], $selected = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.select');
    }
}
