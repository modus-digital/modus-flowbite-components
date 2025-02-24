<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(
        public ?string $title = null,
        public bool $hoverable = false,
        public ?string $footer = null,
        public bool $horizontal = false,
    ) {}

    public function render()
    {
        return view('modus-ui::layout.card', [
            'title' => $this->title,
            'hoverable' => $this->hoverable,
            'footer' => $this->footer,
            'horizontal' => $this->horizontal,
        ]);
    }
}
