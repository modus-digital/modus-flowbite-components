@php
    $preferredColor = $color ?? config('modus-ui.primary_color');

    $color = match($preferredColor) {
        'red' => 'focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500',
        'green' => 'focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-500 dark:focus:border-green-500',
        'blue' => 'focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'indigo' => 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500',
        'purple' => 'focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-500 dark:focus:border-purple-500',
        'pink' => 'focus:ring-pink-500 focus:border-pink-500 dark:focus:ring-pink-500 dark:focus:border-pink-500',
    };
    
    $sizeClasses = match($size) {
        'sm' => 'w-7 h-7 p-2 text-xs',
        'md' => 'w-9 h-9 py-3 text-sm',
        'lg' => 'w-11 h-11 py-3.5 text-base',
        'xl' => 'w-14 h-14 py-4 text-lg',
    };

    $baseClasses = 'block font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white';
    $classes = implode(' ', [$baseClasses, $sizeClasses, $color]);

    $id = empty($id) ? 'pin-input-' . uniqid() : $id;
@endphp

<div class="mb-2">
    @if($label)
        <label for="code-0" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif

    <div class="flex gap-2 space-x-2" data-pin-target="{{ $name }}">
        @for($i = 0; $i < $length; $i++)
            <div x-data>
                <label for="code-{{ $i }}" class="sr-only">code input {{ $i }}</label>
                <input
                    id="code-{{ $i }}"
                    name="code-{{ $i }}"
                    type="text"
                    maxlength="1"
                    class="{{ $classes }}"
                    pattern="{{ $numeric ? '[0-9]' : '.*' }}"
                    inputmode="{{ $numeric ? 'numeric' : 'text' }}"
                    data-focus-input-init
                    data-focus-input-prev="{{ $i > 0 ? "code-" . ($i - 1) : null }}"
                    data-focus-input-next="{{ $i < $length - 1 ? "code-" . ($i + 1) : null }}"

                    {{ $disabled ? 'disabled' : '' }}
                />
            </div>

            @if ($separator && $i === intdiv($length, 2) - 1)
                <span class="text-gray-500 dark:text-gray-400 my-auto text-2xl font-black">-</span>
            @endif
        @endfor

        <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
    </div>

    @if($helperText)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $helperText }}</p>
    @endif
</div>