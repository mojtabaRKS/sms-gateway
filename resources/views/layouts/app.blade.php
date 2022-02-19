<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    <link href="{{ asset('WebFonts/css/style.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    @stack('styles')
</head>

<body class="bg-light">

@yield('content')
@stack('scripts')
</body>
</html>
