@foreach ($post['tags'] as $tag)
    <x-tag-hash :tag="$tag"></x-tag-hash>
@endforeach
<span class="ml-12">
    {{ $post['published_at']->formatLocalized('%d %B %Y') }}
</span>
