<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public function __construct(
        public string $id = '',
        public ?string $title = null,
        public ?string $size = null,
        public bool $show = false,
    ) {}

    public function render()
    {
        return view('modus-ui::layout.modal', [
            'id' => $this->id,
            'title' => $this->title,
            'size' => $this->size,
            'show' => $this->show,
        ]);
    }
}

