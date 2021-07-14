<div class="flex flex-wrap items-center">
    @foreach ($post->tags as $tag)
        <x-tag-hash :url="$tag->url">
            {{ $tag->name }}
        </x-tag-hash>
    @endforeach
    <span class="ml-2 lg:ml-10">
        {{ $post->is_published ? $post->published_at->formatLocalized('%d %B %Y') : __('posts.not_published') }}
    </span>
</div>
