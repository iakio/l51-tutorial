{!! Form::open(['action' => ['UsersController@unfollow', 'id' => $user]]) !!}
    {!! Form::submit('Unfollow', ['class' => 'btn btn-large']) !!}
{!! Form::close() !!}
