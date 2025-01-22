@php
    $baseClasses = 'block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400';

    $sizeClasses = [
        'sm' => 'text-xs mb-5',
        'md' => 'text-sm mb-5',
        'lg' => 'text-lg',
    ];

    $dropzoneBorderColor = match(config('modus-ui.primary_color')) {
        'blue' => 'transition-colors duration-300 hover:border-blue-500',
        'green' => 'transition-colors duration-300 hover:border-green-500',
        'red' => 'transition-colors duration-300 hover:border-red-500',
        'yellow' => 'transition-colors duration-300 hover:border-yellow-500',
        'purple' => 'transition-colors duration-300 hover:border-purple-500',
        'pink' => 'transition-colors duration-300 hover:border-pink-500',
        default => 'transition-colors duration-300 hover:border-gray-500',
    };

    $classes = $baseClasses . ' ' . ($sizeClasses[$size ?? 'md'] ?? $sizeClasses['md']);

    $name = !empty($name) ? $name : 'input-'.Str::random(10);
    $id = !empty($id) ? $id : $name;
@endphp

@if($dropzone)
<div class="mb-2">
    <div
        id="{{ $id }}"
        data-dropzone-target="{{ $id}}"
        @class([
            'dropzone-container cursor-pointer min-h-[150px] max-h-96 border-2 border-dashed rounded-lg p-4 ' . $dropzoneBorderColor,
            'bg-gray-50 dark:bg-gray-700 border-gray-300 dark:border-gray-600',
            'border-red-500 dark:border-red-500' => $errors->has($name),
        ])
    >
        <div class="dropzone-placeholder text-gray-500 dark:text-gray-400 text-center">{{ $placeholder }}</div>
        <div class="dropzone-content space-y-4 hidden"></div>

        <input 
            type="file"
            id="{{ $id }}"
            name="{{ $name }}"
            class="hidden"
            multiple
            
            @if($accept) accept="{{ $accept }}" @endif

            {{ $attributes }}
        />
    </div>
</div>
@else
<div class="mb-2">
    @if($label)
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="{{ $id }}"> {{ $label ?: 'Upload file' }}</label>
    @endif

    <input 
        @class([
            $classes,
            'border-red-500' => $errors->has($name),
        ])
        aria-describedby="{{ $name }}_help"
        id="{{ $id }}"
        name="{{ $name }}"
        type="file"

        @if($multiple) multiple @endif
        @isset($accept) accept="{{ $accept }}" @endisset

        {{ $attributes }}
    >
    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="{{ $name }}_help">SVG, PNG, JPG or GIF (MAX. 800x400px).</p>

    @error($name)
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror
</div>
@endif
