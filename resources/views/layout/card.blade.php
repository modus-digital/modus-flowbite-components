<div @class([
    'bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700',
    'hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-300' => $hoverable,
    'flex' => $horizontal,
])>
    @if($horizontal)
        <div class="flex-shrink-0">
            @isset($image)
                {{ $image }}
            @endisset
        </div>
    @else
        @isset($image)
            {{ $image }}
        @endisset
    @endif

    <div class="p-5">
        @if($title)
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $title }}
            </h5>
        @endif

        <div class="text-gray-700 dark:text-gray-400">
            {{ $slot }}
        </div>

        @if($footer)
            <div class="mt-4">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
