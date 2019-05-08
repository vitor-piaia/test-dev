@php
    $limit = Config::get('system.log.limit');
@endphp

@if ($paginator->lastPage() > 1)
    <div class="paginator">
        <div class="paginator-total">
            <span class="paginator-total__text"><strong>Total de Registros:</strong> {{ $paginator->total() }}</span>
        </div>
        <div class="btn-group pull-right">
            @if(($paginator->currentPage() != 1 && $paginator->lastPage() > $limit))
                <a href="{{ $paginator->appends(request()->input())->url(1) }}" class="btn btn-primary btn-sm">Primeira</a>
            @endif

            @if($paginator->currentPage() > 1)
                <a class="btn btn-primary btn-sm" href="{{ $paginator->appends(request()->input())->previousPageUrl() }}">Anterior</a>
            @endif

            @for ($i = 1; $i <= $paginator->lastPage(); $i++)
                @php
                    $center = floor($limit / 2);
                    $from = $paginator->currentPage() - $center;
                    $to = ($paginator->currentPage() + $center) + 1;

                    if ($paginator->currentPage() < $center) {
                        $to += $center - $paginator->currentPage();
                    }

                    if (($paginator->lastPage() - $paginator->currentPage()) < $center) {
                        $from -= $center - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                    }
                @endphp

                @if ($from < $i && $i < $to)
                    <a class="btn btn-white btn-sm {{ $paginator->currentPage() == $i ? 'active' : '' }}" href="{{ $paginator->appends(request()->input())->url($i) }}">{{ $i }}</a>
                @endif
            @endfor

            @if($paginator->currentPage() != $paginator->lastPage())
                <a class="btn btn-primary btn-sm {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}" href="{{ $paginator->appends(request()->input())->nextPageUrl() }}">Próxima</a>
            @endif

            @if($paginator->currentPage() != $paginator->lastPage() && $paginator->lastPage() > $limit)
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="btn btn-primary btn-sm  {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">Última</a>
            @endif
        </div>
    </div>
@else
    <div class="paginator">
        <div class="paginator-total">
            <span class="paginator-total__text"><strong>Total de Registros:</strong> {{ $paginator->total() }}</span>
        </div>
    </div>
@endif

