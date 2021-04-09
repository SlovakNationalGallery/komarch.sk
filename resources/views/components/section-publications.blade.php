<section>
    <x-heading-section>
        {{ $title }}
    </x-heading-section>
    <img
        src="{{ $imageUrl }}"
        class="object-cover my-10"
    />
    <x-link-arrow :url="$linkUrl">
        {{ $linkTitle }}
    </x-link-arrow>
</section>
