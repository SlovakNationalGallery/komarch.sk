<header class="container-narrow mx-auto">
    @if ($page->cover_image)
        {!! $page->cover_image->img()->attributes(['alt' => e($page->title), 'class' => 'mt-14 max-h-64 w-auto']) !!}
    @endif

    <div class="lg:flex mt-14 text-sm">
        <x-share-bar></x-share-bar>
    </div>
</header>
