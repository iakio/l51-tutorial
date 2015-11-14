<?php $title = "Edit user"; ?>

@extends('layouts.application')
@section('contents')
<h1>Update your profile</h1>

<div class="row">
    <div class="span6 offset3">
        @if (count($errors) > 0)
            <div id="error_explanation">
                <div class="alert alert-error">
                    The form contains {{ Html::pluralize(count($errors), "error") }}.
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>* {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {!! Form::model($user, ['url' => action('UsersController@update', $user->id) ]) !!}

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
