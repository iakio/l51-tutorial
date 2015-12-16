<a href="{{ action('UsersController@show', Auth::user()) }}">
  {!! Html::gravatar_for(Auth::user()) !!}
</a>


<h1>
  {{ Auth::user()->name }}
</h1>
<span>
  <a href="{{ action('UsersController@show', Auth::user()) }}">view my profile</a>
</span>
<span>
  {{ Html::pluralize( Auth::user()->microposts()->count(), "micropost") }}
</span>
