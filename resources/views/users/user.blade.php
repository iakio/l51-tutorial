<li>
    {!! Html::gravatar_for($user, ['size' => 52]) !!}
    <a href="{{ action('UsersController@show', $user->id) }}">{{ $user->name }}</a>
    @if (Auth::user()->admin && Auth::user()->id != $user->id)
        <a href="{{ action('UsersController@destroy', $user->id) }}"
            data-method="delete"
            data-confirm="Are you sure?">delete</a>
    @endif
</li>
