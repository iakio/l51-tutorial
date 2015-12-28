@if (Auth::user()->id != $user->id)
    <div id="follow_form">
    @if (Auth::user()->isFollowing($user))
        @include("users/unfollow")
    @else
        @include("users/follow")
    @endif
    </div>
@endif
