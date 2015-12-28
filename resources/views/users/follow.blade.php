{!! Form::open(['action' => ['UsersController@follow', 'id' => $user]]) !!}
    {!! Form::submit('Follow', ['class' => 'btn btn-large btn-primary']) !!}
{!! Form::close() !!}
