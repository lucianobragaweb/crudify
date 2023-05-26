<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string|null $type = null,
        public string|null $label = null,
        public string|null $class = null,
        public string|null $url = null,
        public string|null $iconLeft = null,
        public string|null $iconRight = null,
        public array|null $dropdown = null,
        public bool|null $small = null,
        public bool|null $pill = null,
        public bool|null $disabled = null,
        public string|null $bsToggle = null,
        public string|null $bsTarget = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.crudify.form.button');
    }
}
