<header class="container-narrow mx-auto">
    <div class="lg:flex mt-20">
        <x-post.post-header-meta :post="$post"></x-post.post-header-meta>
        <x-post.post-header-share :post="$post"></x-post.post-header-share>
    </div>
    <h1 class="text-xl tracking-tight leading-snug mt-4 lg:mt-14">{{ $post->title }}</h1>
</header>
