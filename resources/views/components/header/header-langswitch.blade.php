<!-- TODO: add the mobile version when the design gets finished -->
<ul class="hidden lg:block">
    @foreach(LaravelLocalization::getLocalesOrder() as $localeCode => $properties)
    <li class="capitalize">
        <a
            rel="alternate"
            hreflang="{{ $localeCode }}"
            title="{{ $properties['native'] }}"
            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
            class="block px-2 pb-1 hover:text-blue {{ ($localeCode == LaravelLocalization::getCurrentLocale()) ? 'text-blue' : '' }}"
        >
            {{ $localeCode }}
        </a>
    </li>
    @endforeach
</ul>
