@php
    use Illuminate\Support\Str;

    $id = !empty($id) ? $id : $name . '_' . Str::random(10);

    $baseClasses = 'w-4 h-4 bg-gray-100 border-gray-300 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600';

    $colorClasses = match($color) {
        'red' => 'text-red-600 focus:ring-red-500 dark:focus:ring-red-600',
        'green' => 'text-green-600 focus:ring-green-500 dark:focus:ring-green-600',
        'blue' => 'text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600',
        'indigo' => 'text-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600',
        'purple' => 'text-purple-600 focus:ring-purple-500 dark:focus:ring-purple-600',
        'pink' => 'text-pink-600 focus:ring-pink-500 dark:focus:ring-pink-600',
        default => 'text-blue-600 focus:ring-blue-500 dark:focus:ring-blue-600',
    };

    $classes = $baseClasses . ' ' . $colorClasses;
@endphp

<div class="flex items-center mb-2">
    <input
        type="radio"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        @class([
            $classes,
            'cursor-not-allowed opacity-50' => $disabled,
        ])
        {{ $attributes }}
    />
    @if($label)
        <label for="{{ $id }}" @class([
            'ms-2 text-sm font-medium text-gray-900 dark:text-gray-300',
            'cursor-not-allowed opacity-50' => $disabled,
        ])>
            {{ $label }}
        </label>
    @endif
</div>
