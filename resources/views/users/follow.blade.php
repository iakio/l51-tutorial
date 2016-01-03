{!! Form::open(['action' => ['UsersController@follow', 'user' => $user]]) !!}
    {!! Form::submit('Follow', ['class' => 'btn btn-large btn-primary']) !!}
{!! Form::close() !!}
