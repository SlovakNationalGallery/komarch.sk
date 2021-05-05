<header class="container-article mx-auto">
    <div class="flex mt-16">
        <x-post.post-header-meta :post="$post"></x-post.post-header-meta>
        <x-post.post-header-share :post="$post"></x-post.post-header-share>
    </div>
    <h1 class="text-xl tracking-tight mt-14">{{ $post['title'] }}</h1>
</header>
