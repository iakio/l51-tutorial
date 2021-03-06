<?php $title = "Sign up"; ?>

@extends('layouts.application')
@section('contents')
<h1>Sign up</h1>

<div class="row">
    <div class="span6 offset3">
        @include('shared.error_messages')
        {!! Form::open(['action' => 'Auth\AuthController@postRegister']) !!}

        {!! Form::label('name') !!}
        {!! Form::text('name') !!}

        {!! Form::label('email') !!}
        {!! Form::text('email') !!}

        {!! Form::label('password') !!}
        {!! Form::password('password') !!}

        {!! Form::label('password_confirmation', 'Confirmation') !!}
        {!! Form::password('password_confirmation') !!}

        {!! Form::submit('Create my account', ['class' => 'btn btn-large btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection
