<?php $title = "All users"; ?>

@extends('layouts.application')
@section('contents')
<h1>All users</h1>

<nav class="pagination">
    {!! $users->render() !!}
</nav>
<ul class="users">
    @foreach ($users as $user)
        <li>
            {!! Html::gravatar_for($user, ['size' => 52]) !!}
            <a href="{{ action('UsersController@show', $user->id) }}">{{ $user->name }}</a>
            @if (Auth::user()->admin)
                <a href="">delete</a>
            @endif
        </li>
    @endforeach
</ul>
<nav class="pagination">
    {!! $users->render() !!}
</nav>
@endsection
