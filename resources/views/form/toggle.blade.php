@php
    use Illuminate\Support\Str;

    $name = isset($name) ? $name : 'toggle_' . Str::random(10);

    $baseClasses = 'relative peer bg-gray-200 rounded-full peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-offset-1 dark:bg-gray-700 peer-checked:after:border-white after:content-[""] after:absolute after:bg-white after:border-gray-300 after:border after:rounded-full after:transition-all dark:border-gray-600';
    $sizeClasses = [
        'sm' => 'w-9 h-5 after:top-[2px] after:start-[2px] after:h-4 after:w-4 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full',
        'md' => 'w-11 h-6 after:top-[2px] after:start-[2px] after:h-5 after:w-5 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full',
        'lg' => 'w-14 h-7 after:top-0.5 after:start-[2px] after:h-6 after:w-6 peer-checked:after:translate-x-[28px] rtl:peer-checked:after:-translate-x-[28px]',
    ];
    $colorClasses = [
        'red' => 'peer-checked:bg-red-600 dark:peer-checked:bg-red-600 peer-focus:ring-red-300 dark:peer-focus:ring-red-800',
        'blue' => 'peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800',
        'green' => 'peer-checked:bg-green-600 dark:peer-checked:bg-green-600 peer-focus:ring-green-300 dark:peer-focus:ring-green-800',
        'yellow' => 'peer-checked:bg-yellow-600 dark:peer-checked:bg-yellow-600 peer-focus:ring-yellow-300 dark:peer-focus:ring-yellow-800',
        'purple' => 'peer-checked:bg-purple-600 dark:peer-checked:bg-purple-600 peer-focus:ring-purple-300 dark:peer-focus:ring-purple-800',
        'pink' => 'peer-checked:bg-pink-600 dark:peer-checked:bg-pink-600 peer-focus:ring-pink-300 dark:peer-focus:ring-pink-800',
    ];

    $classes = $baseClasses . ' ' . $sizeClasses[$size] . ' ' . $colorClasses[$color];
@endphp

<label class="inline-flex items-center mb-5 cursor-pointer">
  <input type="checkbox" name="{{ $name }}" value="" class="sr-only peer" {{ $checked ? 'checked' : '' }}>
  <div class="{{ $classes}}"></div>
  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $label }}</span>
</label>