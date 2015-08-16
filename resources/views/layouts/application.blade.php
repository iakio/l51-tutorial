<!DOCTYPE html>
<html>
<head>
    <title>{{ Html::full_title($title) }}</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
@include('layouts.header')
<div class="container">
    @if (session()->get('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @yield('contents')
    @include('layouts.footer')
</div>
</body>
</html>
