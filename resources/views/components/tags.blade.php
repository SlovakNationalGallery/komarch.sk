@if($tags)
    <div class="tags">
        @foreach ($tags->sortBy->name as $tag)
            <a class="btn btn-outline-dark btn-sm mb-2" href="{{ route('posts.index', ['filters[]' => $tag->slug]) }}" role="button">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif