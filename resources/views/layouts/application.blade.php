<!DOCTYPE html>
<html>
<head>
    <title>{{ Html::full_title($title) }}</title>
    <link href="/css/app.css" rel="stylesheet">
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap-dropdown.js"></script>
</head>
<body>
@include('layouts.header')
<div class="container">
    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('contents')
    @include('layouts.footer')
</div>
</body>
</html>
