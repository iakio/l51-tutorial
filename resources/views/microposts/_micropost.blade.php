<li>
    <span class="content">{{ $micropost->content }}</span>
    <span class="timestamp">
        Posted {{ $micropost->created_at->diffForHumans() }} ago
    </span>
</li>
