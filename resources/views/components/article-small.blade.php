<div class="article-small border-bottom py-3">
    <div class="d-flex align-items-center text-secondary">
        @include('components.tags', ['tags' => $post->tags])
        <div class="px-2">·</div>
        <div>
            @include('components.published_at', ['published_at' => $post->published_at])
        </div>
        @if (isSet($post->published_at) && $post->published_at->age > 0)
            <span class="badge badge-warning ml-2 p-2">Viac ako 1 rok starý</span>
        @endif
    </div>

    <div><a href="{{ $post->url }}" class="font-weight-bold text-dark">{{ $post->title }}</a></div>
</div>