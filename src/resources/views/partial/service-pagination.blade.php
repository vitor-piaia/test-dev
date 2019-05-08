@php
    $limit = Config::get('system.log.limit');
@endphp

@if($paginator['total_pages'] > 1)
    <div class="row">
        <div class="col-lg-12 xs-12">
            <div class="btn-group pull-right">
                @if(($paginator['current'] != 1 && $paginator['total_pages'] > $limit))
                    <a href="{{ request()->fullUrlWithQuery(['page' => 1]) }}" class="btn btn-primary btn-sm">Primeira</a>
                @endif

                @if($paginator['current'] > 1)
                    <a class="btn btn-primary btn-sm" href="{{ request()->fullUrlWithQuery(['page' => ($paginator['current'] - 1)]) }}">Anterior</a>
                @endif

                @for ($i = 1; $i <= $paginator['total_pages']; $i++)
                    @php
                        $center = floor($limit / 2);
                        $from = $paginator['current'] - $center;
                        $to = ($paginator['current'] + $center) + 1;

                        if ($paginator['current'] < $center) {
                            $to += $center - $paginator['current'];
                        }

                        if (($paginator['total_pages'] - $paginator['current']) < $center) {
                            $from -= $center - ($paginator['total_pages'] - $paginator['current']) - 1;
                        }
                    @endphp

                    @if ($from < $i && $i < $to)
                        <a class="btn btn-white btn-sm {{ $paginator['current'] == $i ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['page' => $i]) }}">{{ $i }}</a>
                    @endif
                @endfor

                @if($paginator['current'] != $paginator['total_pages'])
                    <a class="btn btn-primary btn-sm" href="{{ request()->fullUrlWithQuery(['page' => ($paginator['current'] + 1)]) }}">Próxima</a>
                @endif

                @if($paginator['current'] != $paginator['total_pages'] && $paginator['total_pages'] > $limit)
                    <a href="{{ request()->fullUrlWithQuery(['page' => $paginator['total_pages']]) }}" class="btn btn-primary btn-sm">Última</a>
                @endif
            </div>
        </div>
    </div>
@endif