<li id="{{ $feed_item->id }}">
    <a href="{{ action('UsersController@show', $feed_item->user->id) }}">
      {!! Html::gravatar_for($feed_item->user) !!}
    </a>
    <span class="user">
        <a href="{{ action('UsersController@show', $feed_item->user_id) }}">{{ $feed_item->user->name }}</a>
    </span>
    <span class="content">{{ $feed_item->content }}</span>
    <span class="timestamp">
        Posted {{ $feed_item->created_at->diffForHumans() }} ago
    </span>
</li>
