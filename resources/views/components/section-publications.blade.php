<section class="mt-20">
    <x-heading-section>
        <x-link-arrow :url="$linkUrl">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>
    <img
        src="{{ $imageUrl }}"
        alt="{{ $imageAlt }}"
        class="object-cover my-10"
    />
    <x-link-arrow :url="$linkUrl">
        {{ $linkTitle }}
    </x-link-arrow>
</section>
