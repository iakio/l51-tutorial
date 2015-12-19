<?php $user = $user ?? Auth::user() ?>
<div class="stats">
    <a href="">
        <strong id="following" class="stat">
            {{ $user->followed_users()->count() }}
        </strong>
        following
    </a>
    <a href="">
        <strong id="followers" class="stat">
            {{ $user->followers()->count() }}
        </strong>
        followers
    </a>
</div>
