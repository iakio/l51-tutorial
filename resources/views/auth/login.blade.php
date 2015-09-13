<?php $title = 'Sign in'; ?>
@extends('layouts.application')
@section('contents')
<h1>Sign in</h1>


<div class="row">
    <div class="span6 offset3">
        {!! Form::open(['action' => 'Auth\AuthController@postLogin']) !!}
            {!! Form::label('email') !!}
            {!! Form::text('email') !!}

            {!! Form::label('password') !!}
            {!! Form::password('password') !!}
            {!! Form::submit('Sign in', ['class' => 'btn btn-large btn-primary']) !!}
        {!! Form::close() !!}
        <p>New user? {!! Html::link("/auth/register", "Sign up now!") !!}</p>
    </div>
</div>
@endsection
