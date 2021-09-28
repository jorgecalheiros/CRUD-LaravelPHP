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
     * The input value (optional)
     */
    public $value;

    /**
     * If input is enabled or not
     */
    public $onlyRead;

    /**
     * Class of input
     */
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $placeholder = '', $value = '', $class = '', $onlyRead = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->onlyRead = $onlyRead;
        $this->class = $class;
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
