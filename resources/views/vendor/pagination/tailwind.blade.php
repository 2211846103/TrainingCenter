@if ($paginator->hasPages())
    <div class="mt-12 flex justify-center">
        <nav class="flex items-center space-x-2" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-4 py-2 text-gray-400 bg-white rounded-md cursor-default">&laquo;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-4 py-2 text-gray-600 bg-white rounded-md hover:bg-gray-100">&laquo;</a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-4 py-2 text-gray-500 bg-white rounded-md">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="px-4 py-2 text-white bg-[#5867dd] rounded-md">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-4 py-2 text-gray-700 bg-white rounded-md hover:bg-gray-100" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-4 py-2 text-gray-600 bg-white rounded-md hover:bg-gray-100">&raquo;</a>
            @else
                <span class="px-4 py-2 text-gray-400 bg-white rounded-md cursor-default">&raquo;</span>
            @endif
        </nav>
    </div>
@endif