<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Vishnu') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @auth
    <link href="{{ asset('css/dash.css') }}" rel="stylesheet">
    @endauth
    <script type="text/javascript">  var req = [];
    var conf = { ajax_url : '\/vjx'};
    </script>
</head>
<body>
<div id="__app">
    @include('common.navigation')

    @yield('content')

    @include('common.footer')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
