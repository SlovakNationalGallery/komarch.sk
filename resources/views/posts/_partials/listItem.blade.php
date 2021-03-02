<li class="pb-5">
    <div class="d-flex align-items-center text-secondary small">
        @include('components.tags', ['tags' => $post->tags])
        <div class="px-2">·</div>
        <div>
            @include('components.published_at', ['published_at' => $post->published_at])
        </div>
    </div>

    <a href="{{ $post->url }}">
        <h4>{{ $post->title }}</h4>
    </a>
    <div>
        {{ $post->excerpt }}
    </div>

</li>