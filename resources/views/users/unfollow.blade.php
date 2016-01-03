{!! Form::open(['action' => ['UsersController@unfollow', 'user' => $user]]) !!}
    {!! Form::submit('Unfollow', ['class' => 'btn btn-large']) !!}
{!! Form::close() !!}
