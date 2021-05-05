@foreach ($post['tags'] as $tag)
    <x-tag-hash :tag="$tag"></x-tag-hash>
@endforeach
<span>{{ $post['published_at'] }}</span>
