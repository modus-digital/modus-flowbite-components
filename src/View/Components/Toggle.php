<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{
    public function __construct(
        public string $name = '',
        public string $label = '',
        public bool $checked = false,
        public bool $disabled = false,
        public string $size = 'md',
        public string $color = 'blue',
    ) {}

    public function render()
    {
        return view('modus-ui::form.toggle', [
            'name' => $this->name,
            'label' => $this->label,
            'checked' => $this->checked,
            'disabled' => $this->disabled,
            'size' => $this->size,
            'color' => $this->color,
        ]);
    }
}
