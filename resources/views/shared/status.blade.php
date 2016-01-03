<?php $user = $user ?? Auth::user() ?>
<div class="stats">
    <a href="{{ action('UsersController@following', ['user' => $user]) }}">
        <strong id="following" class="stat">
            {{ $user->followed_users()->count() }}
        </strong>
        following
    </a>
    <a href="{{ action('UsersController@followers', ['user' => $user]) }}">
        <strong id="followers" class="stat">
            {{ $user->followers()->count() }}
        </strong>
        followers
    </a>
</div>
