<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title')</title>


    {{-- Essentials --}}
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/animate.css') !!}">

    {{-- Plugins --}}
    @section('styles')
    @show

    <link rel="stylesheet" href="{!! asset('css/main.css') !!}"/>
</head>
<body class="login">
    <div class="wrapper-content">
        @yield('content')
    </div>

    @yield('modal')

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

    {{-- Plugins --}}
    @section('scripts')
    @show

    <script src="{!! asset('js/main.min.js') !!}"></script>
</body>
</html>