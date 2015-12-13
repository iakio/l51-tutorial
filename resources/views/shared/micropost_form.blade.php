{!! Form::open(['action' => 'MicropostsController@store']) !!}
    @include("shared/error_messages")
    <div class="field">
        {!! Form::textarea("content", '', ['placeholder' => 'Compose new micropost...']) !!}
    </div>
    {!! Form::submit("Post") !!}
{!! Form::close() !!}
