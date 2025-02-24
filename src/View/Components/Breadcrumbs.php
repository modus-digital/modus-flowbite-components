<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function __construct(
        public string $separator = '>',
        public int $maxItems = 3,
    ) {}

    public function render()
    {
        return view('modus-ui::breadcrumbs');
    }
}
