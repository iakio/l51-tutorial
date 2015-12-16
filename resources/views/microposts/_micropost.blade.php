<li>
    <span class="content">{{ $micropost->content }}</span>
    <span class="timestamp">
        Posted {{ $micropost->created_at->diffForHumans() }} ago
    </span>
    @if (Auth::check() && Auth::user()->id == $micropost->user->id)
        <a href="{{ route('micropost.destroy', $micropost->id) }}"
           title="{{ $micropost->content }}"
           data-method="delete"
           data-confirm="You sure?">delete</a>
    @endif
</li>
