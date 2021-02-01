<li class="pb-2 pt-2 border-top list-unstyled">
    <a href="{{ $post->url }}">
        {{ $post->title }}
    </a>
    <div class="flex content-center text-xs pt-2 mb-2">
        <div class="flex flex-col justify-center text-secondary">
            {{ $post->published_at }}
        </div>

        @include('components.tags', ['tags' => $post->tags])
    </div>

    <div>
        {{ Str::words(strip_tags($post->text), 70) }}
    </div>

</li>
