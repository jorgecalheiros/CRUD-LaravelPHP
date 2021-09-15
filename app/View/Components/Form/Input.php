<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * The input type (e.g.: text, password, hidden)
     */
    public $type;

    /**
     * The input name (user in the request)
     */
    public $name;


    /**
     * Placeholder of input field (optional)
     */
    public $placeholder;

    /**
     * Specify icon of input field (optional)
     */
    public $icon;

    /**
     * The input value (optional)
     */
    public $value;

    /**
     * If input is enabled or not
     */
    public $onlyRead;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $placeholder = '', $icon = '', $value = '', $onlyRead = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->icon = $icon;
        $this->value = $value;
        $this->onlyRead = $onlyRead;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
