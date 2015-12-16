@if ($feed_items)
    <ol class="microposts">
        @foreach ($feed_items as $feed_item)
            @include("shared/feed_item", ['feed_item' => $feed_item])
        @endforeach
    </ol>
    <nav class="pagination">
        {!! $feed_items->render() !!}
    </nav>
@endif
