<?php

namespace ModusDigital\ModusUI\View\Components;

use Illuminate\View\Component;

class FileInput extends Component
{
    public function __construct(
        public string $id = '',
        public string $name = '',
        public string $label = '',
        public ?string $size = null,
        public bool $multiple = false,
        public bool $dropzone = false,
        public string $value = '',
        public string $placeholder = '',
        public string $accept = '',
    ) {}

    public function render()
    {
        return view('modus-ui::form.file-input', [
            'id' => $this->id,
            'name' => $this->name,
            'label' => $this->label,
            'size' => $this->size,
            'multiple' => $this->multiple,
            'dropzone' => $this->dropzone,
            'value' => $this->value,
            'placeholder' => $this->placeholder,
            'accept' => $this->accept,
        ]);
    }
}
