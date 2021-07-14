<header class="container-narrow mx-auto">
    @if ($contest->cover_image)
        {!! $contest->cover_image->img()->attributes(['alt' => $contest->title, 'class' => 'mt-14 h-64 w-auto']) !!}
    @endif

    <div class="lg:flex mt-14">
        <x-contest.contest-header-meta :contest="$contest"></x-contest.contest-header-meta>
        <x-share-bar></x-share-bar>
    </div>
    <h1 class="text-xl tracking-tight leading-snug mt-4 lg:mt-14">{{ $contest->title }}</h1>
</header>
