@php
    $color = !empty($color) ? $color : config('modus-ui.primary_color');
    $baseClass = 'inline-flex items-center justify-center font-medium focus:ring-2 focus:ring-offset-2 focus:outline-hidden text-sm transition-colors duration-300';

    // Size classes based on whether it's icon-only or a standard button
    $sizeClasses = $iconButton ? 'p-2.5' : [
        'xs' => 'px-2.5 py-1.5 text-xs',
        'sm' => 'px-3 py-2 text-sm',
        'md' => 'px-5 py-2.5 text-sm',
        'lg' => 'px-5 py-2.5 text-lg',
        'xl' => 'px-6 py-3 text-xl',
    ][$size];

    // Solid color button classes
    $colors = [
        'gray', 'red', 'yellow', 'green', 'blue', 'purple', 'pink'
    ];

    $solidColorClasses = array_reduce($colors, function ($carry, $color) {
        $carry[$color] = match ($color) {
            'gray' => 'text-white bg-gray-700 hover:bg-gray-800 focus:ring-gray-300 focus:ring-2 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800',
            'red' => 'text-white bg-red-700 hover:bg-red-800 focus:ring-red-300 focus:ring-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900',
            'yellow' => 'text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-300 focus:ring-2 dark:focus:ring-yellow-900',
            'green' => 'text-white bg-green-700 hover:bg-green-800 focus:ring-green-300 focus:ring-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800',
            'blue' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 focus:ring-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800',
            'purple' => 'text-white bg-purple-700 hover:bg-purple-800 focus:ring-purple-300 focus:ring-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900',
            'pink' => 'text-white bg-pink-700 hover:bg-pink-800 focus:ring-pink-300 focus:ring-2 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800',
        };
        return $carry;
    }, []);

    $outlinedColorClasses = array_reduce($colors, function ($carry, $color) {
        $carry[$color] = match ($color) {
            'gray' => 'text-gray-900 hover:text-white border border-gray-700 hover:bg-gray-800 focus:ring-gray-300 focus:ring-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800',
            'red' => 'text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-red-300 focus:ring-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900',
            'yellow' => 'text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-yellow-300 focus:ring-2 dark:border-yellow-300 dark:text-yellow-300 dark:hover:text-white dark:hover:bg-yellow-400 dark:focus:ring-yellow-900',
            'green' => 'text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-green-300 focus:ring-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800',
            'blue' => 'text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-blue-300 focus:ring-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-800',
            'purple' => 'text-purple-700 hover:text-white border border-purple-700 hover:bg-purple-800 focus:ring-purple-300 focus:ring-2 dark:border-purple-400 dark:text-purple-400 dark:hover:text-white dark:hover:bg-purple-500 dark:focus:ring-purple-900',
            'pink' => 'text-pink-700 hover:text-white border border-pink-700 hover:bg-pink-800 focus:ring-pink-300 focus:ring-2 dark:border-pink-500 dark:text-pink-500 dark:hover:text-white dark:hover:bg-pink-600 dark:focus:ring-pink-800',
        };
        return $carry;
    }, []);

    // Gebruik
    $solidClass = $solidColorClasses[$color];
    $outlinedClass = $outlinedColorClasses[$color];


    // Final class assignment
    $colorClasses = $outlined ? $outlinedColorClasses[$color] : $solidColorClasses[$color];
    $roundedClasses = $rounded ? 'rounded-full' : 'rounded-sm';
    $disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed' : '';

    $buttonClass = implode(' ', [$baseClass, $sizeClasses, $colorClasses, $roundedClasses, $disabledClasses]);

    // Icon positioning based on if icon-only no margin is needed else margin is needed based on position
    $iconClass = $iconButton ? '' : ($iconPosition === 'left' ? 'mr-2' : 'ml-2');
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $buttonClass]) }} {{ $disabled ? 'aria-disabled=true tabindex=-1' : '' }} {{ $attributes }}>
        @if (isset($icon) && $iconPosition === 'left')
            <span class="{{ $iconClass }}">{{ $icon }}</span>
        @endif
        @unless ($iconButton)
            {{ $slot }}
        @endunless
        @if (isset($icon) && $iconPosition === 'right')
            <span class="{{ $iconClass }}">{{ $icon }}</span>
        @endif
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $buttonClass]) }} {{ $disabled ? 'disabled' : '' }} {{ $attributes }}>
        @if (isset($icon) && $iconPosition === 'left')
            <span class="{{ $iconClass }}">{{ $icon }}</span>
        @endif
        @unless ($iconButton)
            {{ $slot }}
        @endunless
        @if (isset($icon) && $iconPosition === 'right')
            <span class="{{ $iconClass }}">{{ $icon }}</span>
        @endif
    </button>
@endif
