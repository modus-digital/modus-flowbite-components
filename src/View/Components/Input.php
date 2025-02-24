<?php

namespace ModusDigital\ModusUI\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Input extends Component
{
    public function __construct(
        public string $type = 'text',
        public string $id = '',
        public string $name = '',
        public string $label = '',
        public string $placeholder = '',
        public string $value = '',
        public bool $disabled = false,
        public bool $required = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('modus-ui::form.input', [
            'color' => config('modus-ui.primary_color'),
            'type' => $this->type,
            'name' => $this->name,
            'label' => $this->label,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'disabled' => $this->disabled,
            'required' => $this->required,

        ]);
    }
}
