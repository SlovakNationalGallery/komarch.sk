@if($tags)
    <div class="tags">
        @foreach ($tags->sortBy->name as $tag)
            <a class="btn btn-outline-dark btn-sm mb-2 small" href="{{ route('posts.index', ['categories[]' => $tag->name]) }}" role="button">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif