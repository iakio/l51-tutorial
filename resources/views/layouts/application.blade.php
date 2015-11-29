<!DOCTYPE html>
<html>
<head>
    <title>{{ Html::full_title($title) }}</title>
    <link href="/css/app.css" rel="stylesheet">
    <meta name="csrf-param" content="_token">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-alert.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
    <script src="/js/rails.js"></script>
</head>
<body>
@include('layouts.header')
<div class="container">
    @include('flash::message')
    @yield('contents')
    @include('layouts.footer')
</div>
</body>
</html>
