<?php

namespace ModusDigital\ModusUI\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Textarea extends Component
{
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $label = '',
        public string $value = '',
        public string $placeholder = '',
        public bool $disabled = false,
        public bool $required = false,
        public int $rows = 2
    ) {}

    public function render(): View|Closure|string
    {
        return view('modus-ui::form.textarea', [
            'color' => config('modus-ui.primary_color'),
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'placeholder' => $this->placeholder,
            'value' => $this->value,
            'disabled' => $this->disabled,
            'required' => $this->required,
            'rows' => $this->rows,
        ]);
    }
}
