<header class="container-narrow mx-auto">
    <image-gallery :work-id="{{ $work->id }}"></image-gallery>
    <x-work.work-header-meta :work="$work"></x-work.work-header-meta>
    <div class="flex items-center space-between mt-4 lg:mt-14">
        <h1 class="text-xl tracking-tight leading-snug">{{ $work->name }}</h1>
        <x-share-bar></x-share-bar>
    </div>
</header>
