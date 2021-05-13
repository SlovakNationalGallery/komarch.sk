<div class="flex flex-wrap items-center">
    @foreach ($post->tags as $tag)
        <x-tag-hash :tag="$tag"></x-tag-hash>
    @endforeach
    <span class="ml-2 lg:ml-10">
        {{ $post->is_published ? $post->published_at->formatLocalized('%d %B %Y') : __('post.not_published') }}
    </span>
</div>
