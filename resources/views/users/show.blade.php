<?php $title = $user->name; ?>
@extends("layouts.application")

@section("contents")
    <div class="row">
        <aside class="span4">
            <section>
                <h1>
                    {!! Html::gravatar_for($user) !!}
                    {{ $user->name }}
                </h1>
            </section>
            <section>
                @include('shared.status')
            </section>
        </aside>
        <div class="span8">
            @if (Auth::check())
                @include('users.follow_form')
            @endif
            @if ($microposts->count() > 0)
                <h3>Microposts ({{ $user->microposts->count() }})</h3>
                <ol class="microposts">
                @foreach ($microposts as $micropost)
                    @include("microposts._micropost")
                @endforeach
                </ol>
                <nav class="pagination">
                    {!! $microposts->render() !!}
                </nav>
            @endif
        </div>
    </div>
@endsection
