<section class="mt-20">
    <x-heading-section>
        <x-link-arrow :url="$titleUrl">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>
    <x-link-arrow :url="$mapUrl" class="mt-10">
        Zobraz celú mapu
    </x-link-arrow>
    <artworks-map />
</section>
