@php
    use Illuminate\Support\Str;

    $name = !empty($name) ? $name : 'input-'.Str::random(10);
    $id = !empty($id) ? $id : $name;

    $preferredColor = $color ?? config('modus-ui.primary_color');

    $color = match($preferredColor) {
        'red' => 'focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500',
        'green' => 'focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-500 dark:focus:border-green-500',
        'blue' => 'focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'indigo' => 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500',
        'purple' => 'focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-500 dark:focus:border-purple-500',
        'pink' => 'focus:ring-pink-500 focus:border-pink-500 dark:focus:ring-pink-500 dark:focus:border-pink-500',
    };

    $baseClasses = 'block p-2.5 w-full outline-hidden text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white';
@endphp

<div class="mb-2">
    @if($label)
        <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    @endif

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ old($name) ?? $value ?? '' }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        {{ $attributes }}
        @class([
            $baseClasses,
            $color,
            'border-red-500' => $errors->has($name),
            'cursor-not-allowed opacity-50' => $disabled,
        ])
        {{ $disabled ? 'disabled' : '' }}
    >{{ $value }}</textarea>

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
