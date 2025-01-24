@php
    use Illuminate\Support\Str;

    $name = !empty($name) ? $name : 'input-'.Str::random(10);
    $id = !empty($id) ? $id : $name;

    $name = $multiple && !str_ends_with($name, '[]') ? $name.'[]' : $name;

    $color = match(config('modus-ui.primary_color', 'blue')) {
        'red' => 'focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500',
        'green' => 'focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-500 dark:focus:border-green-500',
        'blue' => 'focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500',
        'indigo' => 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500',
        'purple' => 'focus:ring-purple-500 focus:border-purple-500 dark:focus:ring-purple-500 dark:focus:border-purple-500',
        'pink' => 'focus:ring-pink-500 focus:border-pink-500 dark:focus:ring-pink-500 dark:focus:border-pink-500',
    };

    $sizes = [
        'sm' => [
            'button' => 'py-1.5 pl-3 pr-10 text-sm',
            'search' => 'py-1 text-sm',
            'option' => 'py-1.5 pl-3 pr-9 text-sm',
        ],
        'md' => [
            'button' => 'py-2 pl-3 pr-10 text-base',
            'search' => 'py-2 text-base',
            'option' => 'py-2 pl-3 pr-9 text-base',
        ],
        'lg' => [
            'button' => 'py-2.5 pl-4 pr-10 text-lg',
            'search' => 'py-2.5 text-lg',
            'option' => 'py-2.5 pl-4 pr-9 text-lg',
        ],
        'xl' => [
            'button' => 'py-3 pl-4 pr-10 text-xl',
            'search' => 'py-3 text-xl',
            'option' => 'py-3 pl-4 pr-9 text-xl',
        ],
    ];

    $currentSize = $sizes[$size] ?? $sizes['md'];
@endphp

<div 
    x-data="select({
        name: '{{ $name }}',
        options: {{ json_encode($options ?? []) }},
        placeholder: '{{ $placeholder }}',
        value: '{{ $value }}',
        required: {{ $required ? 'true' : 'false' }},
        searchable: {{ $searchable ? 'true' : 'false' }},
        multiple: {{ $multiple ? 'true' : 'false' }}
    })"
    class="relative"
    x-cloak
>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>

    <div class="relative">
        <button 
            type="button"
            @click="toggle"
            @click.away="close"
            class="relative w-full cursor-pointer bg-white border border-gray-300 rounded-md text-left focus:outline-hidden focus:ring-1 {{ $color }} {{ $currentSize['button'] }}"
            :class="{ 'border-red-500': error }"
        >
            <span x-text="selectedLabel" class="block truncate" :class="{ 'text-gray-500': !selectedLabel }"></span>
            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <template x-if="!multiple">
            <input type="hidden" :name="name" x-model="selectedValue">
        </template>
        <template x-if="multiple">
            <template x-for="value in selectedValue" :key="value">
                <input type="hidden" :name="name" :value="value">
            </template>
        </template>

        <div 
            x-show="isOpen"
            x-transition
            class="absolute z-10 w-full bg-white shadow-lg rounded-md text-base focus:outline-hidden sm:text-sm overflow-hidden top-full mt-2"
        >
            <div x-show="searchable" class="sticky top-0 z-20 bg-white border-b border-gray-200">
                <div class="px-3 py-2">
                    <div class="relative">
                            <input
                                x-ref="searchInput"
                                type="text"
                                class="w-full border-gray-300 rounded-md shadow-xs appearance-none {{ $color }} {{ $currentSize['search'] }}"
                                placeholder="Search..."
                                x-model="search"
                                @click.stop
                            >
                            <button 
                                x-show="search.length > 0"
                                @click.stop="search = ''; $refs.searchInput.focus()"
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-2 cursor-pointer"
                            >
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
            </div>
            
            <div class="overflow-y-auto max-h-[calc(15rem-56px)] select-scrollbar">
                <div x-show="filteredOptions.length === 0" class="px-3 py-2 text-sm text-gray-500 text-center" x-cloak>
                    No options found
                </div>

                <template x-for="option in filteredOptions" :key="option.value">
                    <div
                        @click="select(option)"
                        @click.stop="!multiple && close()"
                        class="cursor-pointer select-none relative hover:bg-gray-100 {{ $currentSize['option'] }}"
                        :class="{ 'bg-primary-50': isSelected(option) }"
                    >
                        <span x-text="option.label" class="block truncate"></span>
                        <span 
                            x-show="isSelected(option)" 
                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                            :class="{ 'text-red-600': '{{ str_contains($color, 'red') }}',
                                     'text-green-600': '{{ str_contains($color, 'green') }}',
                                     'text-blue-600': '{{ str_contains($color, 'blue') }}',
                                     'text-indigo-600': '{{ str_contains($color, 'indigo') }}',
                                     'text-purple-600': '{{ str_contains($color, 'purple') }}',
                                     'text-pink-600': '{{ str_contains($color, 'pink') }}' }"
                        >
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
