<div class="flex items-center">
    @php
        $parts = explode('/', $url);
        $total = count($parts);
        $visibleItems = [];

        // Always show home
        if (isset($parts[0])) {
            $visibleItems[] = $parts[0];
        }

        // If we have more items than max, add ellipsis
        if ($total > $maxItems) {
            $visibleItems[] = '...';

            // Add last 2 items
            if (isset($parts[$total-2])) {
                $visibleItems[] = $parts[$total-2];
            }
            if (isset($parts[$total-1])) {
                $visibleItems[] = $parts[$total-1];
            }
        } else {
            // Add all remaining items if less than max
            for ($i = 1; $i < $total; $i++) {
                $visibleItems[] = $parts[$i];
            }
        }
    @endphp

    @foreach ($visibleItems as $index => $breadcrumb)
        @if ($index > 0)
            <span class="mx-2 text-gray-400">{{ $separator }}</span>
        @endif

        @if ($breadcrumb === '...')
            <span class="text-gray-400">{{ $breadcrumb }}</span>
        @else
            <a href="{{ $breadcrumb }}" class="text-gray-500 hover:text-gray-700">{{ $breadcrumb }}</a>
        @endif
    @endforeach
</div>

