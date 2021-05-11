<section class="mt-20">
    <x-heading-section>
        <x-link-arrow :url="$linkUrl">
            {{ $title }}
        </x-link-arrow>
    </x-heading-section>

    @foreach ($publications as $publication)
        <div class="px-5 sm:px-10">
            <img
                src="{{ Storage::url($publication->cover_image) }}"
                alt="{{ $publication->name }}"
                class="object-cover mt-10 mb-7 mx-auto shadow-2xl sm:max-w-xs"
            />
        </div>
        <x-link-arrow :url="$publication->issuu_url" class="mb-5">
            {{ trans('app.read_on_issuu') }}
        </x-link-arrow>
    @endforeach

</section>
