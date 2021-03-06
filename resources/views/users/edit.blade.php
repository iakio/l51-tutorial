<?php $title = "Edit user"; ?>

@extends('layouts.application')
@section('contents')
<h1>Update your profile</h1>

<div class="row">
    <div class="span6 offset3">
        @include('shared.error_messages')
        {!! Form::model($user, ['url' => action('UsersController@update', $user->id), 'method' => 'patch']) !!}

        {!! Form::label('name') !!}
        {!! Form::text('name') !!}

        {!! Form::label('email') !!}
        {!! Form::text('email') !!}

        {!! Form::label('password') !!}
        {!! Form::password('password') !!}

        {!! Form::label('password_confirmation', 'Confirmation') !!}
        {!! Form::password('password_confirmation') !!}

        {!! Form::submit('Save changes', ['class' => 'btn btn-large btn-primary']) !!}
        {!! Form::close() !!}

        {!! Html::gravatar_for($user) !!}
        <a href="http://gravatar.com/emails">change</a>
    </div>
</div>
@endsection
