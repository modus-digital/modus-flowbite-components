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
@endphp

<div class="mb-2">
    @if($label)
        <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}

            @if($required)
                <span class="text-red-500 font-bold">*</span>
            @endif
        </label>
    @endif

    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name) ?? $value ?? '' }}"
        {{ $disabled ? 'disabled' : '' }}

        @class([
            'border text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:border-gray-600 border-gray-300 ' . $color,
            'dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white outline-hidden',
            'border-red-500' => $errors->has($name),
            'cursor-not-allowed opacity-50' => $disabled,
        ])

        {{ $attributes }}
    />

    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>
