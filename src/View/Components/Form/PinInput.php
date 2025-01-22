<?php

namespace ModusDigital\ModusUI\View\Components\Form;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class PinInput extends Component
{
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $label = '',
        public string $value = '',
        public string $size = 'md',
        public int $length = 6,
        public bool $separator = false,
        public bool $disabled = false,
        public bool $numeric = true,
        public string $helperText = '',
    ) {}

    public function render(): View|Closure|string
    {
        return view('modus-ui::form.pin-input', [
            'color' => config('modus-ui.primary_color'),
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value,
            'size' => $this->size,
            'length' => $this->length,
            'separator' => $this->separator,
            'disabled' => $this->disabled,
            'numeric' => $this->numeric,
            'helperText' => $this->helperText,
        ]);
    }
}