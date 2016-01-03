@extends('layouts.application')

@section('contents')
    <div class="row">
        <aside class="span4">
            <section>
                {!! Html::gravatar_for($user) !!}
                <h1>
                    {{ $user->name }}
                </h1>
                <span><a href="{{ action('UsersController@show', ['id' => $user]) }}">view my  profile</a></span>
                <span><b>Microposts:</b> {{ $user->microposts()->count() }}</span>
            </section>
            <section>
                @include('shared.status')
                @if ($users->count() > 0)
                    <div class="user_avatars">
                        @foreach ($users as $user)
                            <a href="{{ action('UsersController@show', ['id' => $user]) }}">
                                {!! Html::gravatar_for($user, ['size' => 30]) !!}
                            </a>
                        @endforeach
                    </div>
                @endif
            </section>
        </aside>
        <div class="span8">
            <h3>{{ $title }}</h3>
            @if ($users->count() > 0)
                <ul class="users">
                    @foreach ($users as $user)
                        @include('users.user')
                    @endforeach
                </ul>
                <nav class="pagination">
                    {!! $users->render() !!}
                </nav>
            @endif
        </div>
    </div>
@endsection
