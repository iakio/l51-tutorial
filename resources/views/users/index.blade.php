<?php $title = "All users"; ?>

@extends('layouts.application')
@section('contents')
<h1>All users</h1>

<nav class="pagination">
    {!! $users->render() !!}
</nav>
<ul class="users">
    @foreach ($users as $user)
        @include('users.user')
    @endforeach
</ul>
<nav class="pagination">
    {!! $users->render() !!}
</nav>
@endsection
