<?php

namespace ModusDigital\ModusUI\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $label = '',
        public bool $checked = false,
        public bool $disabled = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('modus-ui::form.checkbox', [
            'color' => config('modus-ui.primary_color'),
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'checked' => $this->checked,
            'disabled' => $this->disabled,
        ]);
    }
}
