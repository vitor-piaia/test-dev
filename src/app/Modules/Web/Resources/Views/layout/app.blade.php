<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/font-awesome.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/style.css') !!}">

        @section('styles')
        @show

        <link rel="stylesheet" href="{!! asset('css/main.css') !!}">
    </head>


{{--    <body class="{{ isActiveRoute(['adm.product', 'adm.product.configure']) ? 'full-height-layout' : '' }}">--}}
    <body>
        <div id="wrapper">
            {{-- Sidebar --}}
            @include('web::layout.partials.sidebar')

        <div id="page-wrapper" class="gray-bg">
            {{-- Navbar --}}
            @include('web::layout.partials.navbar')

            @yield('content')

            </div>
        </div>

        @yield('modal')
        <div class="modal inmodal in" id="default-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>

        <!-- Mainly scripts -->
        <script src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
        <script src="{!! asset('js/bootstrap.min.js') !!}"></script>
        <script src="{!! asset('libs/metisMenu/jquery.metisMenu.min.js') !!}"></script>
        <script src="{!! asset('libs/slimscroll/jquery.slimscroll.min.js') !!}"></script>
        <script src="{!! asset('js/jquery.mask.min.js') !!}" type="text/javascript"></script>
        <script src="{!! asset('js/app.js') !!}"></script>
        <script src="{!! asset('js/request.js') !!}"></script>
        <script src="{!! asset('js/status.js') !!}"></script>
        <script src="{!! asset('js/functions.js') !!}"></script>
        <script src="{!! asset('js/error.js') !!}"></script>
        <script src="{!! asset('js/modal/modal.js') !!}"></script>
        <script src="{!! asset('js/modal/template.js') !!}"></script>
        <script src="{!! asset('js/main.js') !!}"></script>

        <!-- Plugins -->
        @section('scripts')
        @show()
    </body>
</html>

