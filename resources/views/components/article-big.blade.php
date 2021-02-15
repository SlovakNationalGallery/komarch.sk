<div class="article-big py-3">
    <div class="mb-3">
        <img src="https://placekitten.com/640/360" class="img-fluid" />
    </div>
    <div class="d-flex align-items-center text-secondary">
        @include('components.tags', ['tags' => $post->tags])
        <div class="px-2">·</div>
        <div>
            @include('components.published_at', ['published_at' => $post->published_at])
        </div>
    </div>

    <h4>
        <a href="{{ $post->url }}" class="font-weight-bold text-dark">{{ $post->title }}</a>
    </h4>

    <div>
        {!! nl2br(Str::words(strip_tags($post->text), 50)) !!}
    </div>
</div>