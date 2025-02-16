<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Field extends Component
{
    protected $prop = [];
    /**
     * Create a new component instance.
     */
    public function __construct($name, $id, $type="text", $label=null, $value=null)
    {
        $this->prop["id"] = $id;
        $this->prop["name"] = $name;
        $this->prop["type"] = $type;
        $this->prop["label"] = $label;
        $this->prop["value"] = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.field', $this->prop);
    }
}
