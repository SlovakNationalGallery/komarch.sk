<header class="container-article mx-auto">
    <div class="flex mt-16">
        @foreach ($post['tags'] as $tag)
            <span class="mr-4">{{ $tag['name'] }}</span>
        @endforeach
        <span>{{ $post['published_at'] }}</span>
        <span class="ml-auto">email</span>
        <span>link</span>
        <span>facebook</span>
    </div>
    <h1 class="text-xl tracking-tight mt-14">{{ $post['title'] }}</h1>
</header>
