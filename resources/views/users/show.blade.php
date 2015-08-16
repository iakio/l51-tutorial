<?php $title = $user->name; ?>
@extends("layouts.application")

@section("contents")
    <div class="row">
        <aside class="span4">
            <section>
                <h1>
                    {!! Html::gravatar_for($user) !!}
                    {{ $user->name }}
                </h1>
            </section>
        </aside>
    </div>
@endsection
