@php
    use Illuminate\Support\Str;

    $name = !empty($name) ? $name : 'input-'.Str::random(10);
    $id = !empty($id) ? $id : $name;

    $preferredColor = $color ?? config('modus-ui.primary_color');

    $classes = match($preferredColor) {
        'red' => 'w-4 h-4 text-red-600 bg-gray-100 border-gray-300 rounded focus:ring-red-500 dark:focus:ring-red-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'green' => 'w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'blue' => 'w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'indigo' => 'w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'purple' => 'w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-purple-500 dark:focus:ring-purple-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
        'pink' => 'w-4 h-4 text-pink-600 bg-gray-100 border-gray-300 rounded focus:ring-pink-500 dark:focus:ring-pink-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600',
    };
@endphp

<div class="flex items-center mb-2 me-4">
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        {{ $checked ? 'checked' : '' }}
        {{ $disabled ? 'disabled' : '' }}
        @class([
            $classes,
            'border-red-500' => $errors->has($name),
            'cursor-not-allowed opacity-50' => $disabled,
        ])
        {{ $attributes }}
    />

    @if($label)
        <label for="{{ $id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif
</div>
