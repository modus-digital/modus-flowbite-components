<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class Radio extends Component
{
    public function __construct(
        public string $name = '',
        public string $value = '',
        public string $label = '',
        public bool $checked = false,
        public bool $disabled = false,
        public ?string $id = null,
        public ?string $color = 'blue',
    ) {}

    public function render()
    {
        return view('modus-ui::form.radio', [
            'name' => $this->name,
            'value' => $this->value,
            'label' => $this->label,
            'checked' => $this->checked,
            'disabled' => $this->disabled,
            'id' => $this->id,
            'color' => $this->color,
        ]);
    }
}
