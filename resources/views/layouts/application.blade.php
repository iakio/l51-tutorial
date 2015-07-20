<!DOCTYPE html>
<html>
<head>
    <title>{{ full_title($title) }}</title>
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
@include('layouts.header')
<div class="container">
    @yield('contents')
    @include('layouts.footer')
</div>
</body>
</html>
