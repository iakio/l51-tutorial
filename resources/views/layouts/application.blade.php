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
    @if (session()->get('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if (count(@errors) > 0)
         @foreach ($errors->all() as $error)
            <div class="alert alert-error">{{ $error }}</div>
         @endforeach
    @endif
    @yield('contents')
    @include('layouts.footer')
</div>
</body>
</html>
