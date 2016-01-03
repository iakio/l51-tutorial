{!! Form::open(['route' => ['user.unfollow', 'user' => $user]]) !!}
    {!! Form::submit('Unfollow', ['class' => 'btn btn-large']) !!}
{!! Form::close() !!}
