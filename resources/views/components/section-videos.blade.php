<section class="mt-20">
    <x-heading-section>
        {{ $title }}
    </x-heading-section>
    <div class="relative aspect-w-16 aspect-h-9 my-10">
        <iframe
            src="{{ $embedUrl }}"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            class="absolute w-full h-full"
        >
        </iframe>
    </div>
    <x-link-arrow :url="$linkUrl">
        {{ $linkTitle }}
    </x-link-arrow>
</section>
