<header class="container-article mx-auto">
    <img src="https://placekitten.com/640/360" alt="cat">
    <div class="flex mt-16">
        <span>{{ $post['tags'][0]['name'] }}</span>
        <span>{{ $post['published_at'] }}</span>
        <span class="ml-auto">email</span>
        <span>link</span>
        <span>facebook</span>
    </div>
    <h1 class="text-xl tracking-tight mt-14">{{ $post['title'] }}</h1>
</header>
