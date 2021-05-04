<header class="container-article mx-auto">
    <div class="flex mt-16">
        @foreach ($post['tags'] as $tag)
            <x-tag-hash :tag="$tag"></x-tag-hash>
        @endforeach
        <span>{{ $post['published_at'] }}</span>
        <a
            class="ml-auto"
            href="mailto:?to=&body={{ Request::url() }}"
            target="_blank"
        >
            email
        </a>
        <a class="ml-4">link</a>
        <a
            class="ml-4"
            href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
            target="_blank"
        >
            facebook
        </a>
    </div>
    <h1 class="text-xl tracking-tight mt-14">{{ $post['title'] }}</h1>
</header>
