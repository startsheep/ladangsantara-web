@if ($paginator->hasPages())
    <div class="flex sm:mt-0 mt-4 justify-center">
        <p class="mr-5">
            @if ($paginator->firstItem())
                {{ $paginator->firstItem() . ' - ' . $paginator->lastItem() }}
            @else
                {{ $paginator->count() }}
            @endif
        </p>
        <p class="mr-5">dari</p>
        <p class="mr-5">{{ $paginator->total() }}</p>
        <div class="ml-4">
            @if ($paginator->onFirstPage())
                <span class="cursor-default text-gray-400"><i class="fa-solid fa-arrow-left mr-4"></i></span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"><i
                        class="fa-solid fa-arrow-left mr-4 cursor-pointer"></i></a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"><i class="fa-solid fa-arrow-right cursor-pointer"></i></a>
            @else
                <span class="cursor-default text-gray-400"><i class="fa-solid fa-arrow-right"></i></span>
            @endif
        </div>
    </div>
@endif
