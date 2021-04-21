<nav class="flex flex-col-reverse text-lg xl:flex-row xl:text-base">
    <x-footer.footer-navigation-column :title="$navigation['title']">
        <ul>
            @foreach ($navigation['navItems'] as $item)
                <li>
                    <x-link-arrow-hover :url="$item['url']">
                        {{ $item['title'] }}
                    </x-link-arrow-hover>
                </li>
            @endforeach
        </ul>
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column :title="$openingTimes['title']">
        <x-footer.opening-hours />
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column title="Kontakt">
        Námeste SNP 18, 811 06 Bratislava
        <x-link-arrow url="mailto:komarch@komarch.sk" class="mt-6 md:mt-4">
            komarch@komarch.sk
        </x-link-arrow>
        <x-link-arrow-hover url="tel:+421254432080" class="mt-6 md:mt-4">
            + 421 254 432 080
        </x-link-arrow-hover>
        <x-link-arrow-hover url="tel:+421254432254">
            + 421 254 432 254
        </x-link-arrow-hover>
        <x-link-arrow
            url="https://www.facebook.com/slovenskakomoraarchitektov" class="block mt-6 md:mt-4">
            Facebook
        </x-link-arrow>
        <x-link-arrow url="https://www.instagram.com/slovenskakomoraarchitektov">
            Instagram
        </x-link-arrow>
        <x-link-arrow url="https://issuu.com/institutska">
            ISSUU
        </x-link-arrow>
    </x-footer.footer-navigation-column>
</nav>
