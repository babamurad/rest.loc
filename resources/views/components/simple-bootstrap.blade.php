@if ($paginator->hasPages())
<div class="fp__pagination mt_35">
    <nav aria-label="Навигация по страницам">
        <ul class="pagination">
            {{-- Ссылка на предыдущую страницу --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                @if ($paginator->onFirstPage())
                    <span class="page-link">
                        <i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                    </span>
                @else
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" wire:navigate>
                        <i class="fas fa-long-arrow-alt-left" aria-hidden="true"></i>
                    </a>
                @endif
            </li>

            {{-- Элементы пагинации --}}
            @foreach ($elements as $element)
                {{-- Разделитель "..." --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Массив ссылок --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            @if ($page == $paginator->currentPage())
                                <span class="page-link">{{ $page }}</span>
                            @else
                                <a class="page-link" href="{{ $url }}" wire:navigate>{{ $page }}</a>
                            @endif
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Ссылка на следующую страницу --}}
            <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                @if ($paginator->hasMorePages())
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" wire:navigate>
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                    </a>
                @else
                    <span class="page-link">
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                    </span>
                @endif
            </li>
        </ul>
    </nav>
</div>
@endif