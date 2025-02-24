<?php

namespace ModusDigital\ModusUI\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Button extends Component
{
    public function __construct(
        public string $color = '',
        public ?string $href = null,
        public string $type = 'button',
        public string $size = 'md',
        public bool $outlined = false,
        public bool $rounded = false,
        public bool $disabled = false,
        public bool $iconButton = false,
        public string $iconPosition = 'left',
    ) {}

    public function render(): View|Closure|string
    {
        return view('modus-ui::form.button', [
            'color' => $this->color,
            'href' => $this->href,
            'type' => $this->type,
            'size' => $this->size,
            'outlined' => $this->outlined,
            'rounded' => $this->rounded,
            'disabled' => $this->disabled,
            'iconButton' => $this->iconButton,
            'iconPosition' => $this->iconPosition,
        ]);
    }
}
