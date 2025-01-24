<?php

namespace ModusDigital\ModusUI\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public function __construct(
        public string $name,
        public string $label,
        public array $options = [],
        public string $placeholder = '',
        public bool $searchable = false,
        public bool $multiple = false,
        public string $value = '',
        public bool $required = false,
        public string $size = 'md',
    ) {}

    public function render()
    {
        return view('modus-ui::form.select', [
            'name' => $this->name,
            'label' => $this->label,
            'options' => $this->options,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'required' => $this->required,
            'searchable' => $this->searchable,
            'multiple' => $this->multiple,
        ]);
    }
}