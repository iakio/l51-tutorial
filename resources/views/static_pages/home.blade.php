<?php $title = ""; ?>
@extends("layouts.application")

@section("contents")
@if (Auth::check())
    <div class="row">
        <aside class="span4">
            <section>
                @include('shared/user_info')
            </section>
            <section>
                @include('shared/status')
            </section>
            <section>
                @include('shared/micropost_form')
            </section>
        </aside>
        <div class="span8">
            <h3>Micropost Feed</h3>
            @include("shared/feed")
        </div>
    </div>
@else
    <div class="center hero-unit">
        <h1>Sample App</h1>
        <h2>
            This is the home page for the
            <a href="http://railstutorial.jp">Ruby on Rails Tutorial</a>
            sample application.
        </h2>
        <a class="btn btn-large btn-primary" href="/auth/register">Sign up now!</a>
    </div>
@endif
@endsection
