<nav class="flex flex-col-reverse text-lg xl:flex-row xl:text-base">
    <x-footer.footer-navigation-column :title="$navigation['title']">
        <ul>
            @foreach ($navigation['navItems'] as $item)
                <li>
                    <x-link-arrow :link="$item" />
                </li>
            @endforeach
        </ul>
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column title="Úradné hodiny">
        <table>
            <tr>
                <td class="w-32 xl:w-24">Pondelok</td><td class="w-32">08:00 - 12:00</td><td>13:00 - 16:00</td>
            <tr>
            <tr>
                <td>Utorok</td><td>08:00 - 12:00</td><td>13:00 - 16:00</td>
            </tr>
            <tr>
                <td>Streda</td><td>08:00 - 12:00</td><td>13:00 - 16:00</td>
            </tr>
            <tr>
                <td>Štvrtok</td><td>08:00 - 12:00</td><td>13:00 - 16:00</td>
            </tr>
            <tr>
                <td>Piatok</td><td colspan="2">Nestránkový deň</td>
            </tr>
        </table>
        <span class="block mt-5">(Práve teraz máme otvorené)</span>
    </x-footer.footer-navigation-column>
    <x-footer.footer-navigation-column title="Kontakt">
        Námeste SNP 18, 811 06 Bratislava
        <!-- TODO: switch to arrow link components from filters -->
        <a href="mailto:komarch@komarch.sk" target="_blank" class="block mt-6 md:mt-4">komarch@komarch.sk</a>
        <a href="tel:+421254432080" target="_blank" class="block">+ 421 254 432 080</a>
        <a href="tel:+421254432254" target="_blank" class="block">+ 421 254 432 254</a>
        <a href="https://www.facebook.com/slovenskakomoraarchitektov" target="_blank" class="block mt-6 md:mt-4">Facebook</a>
        <a href="https://www.instagram.com/slovenskakomoraarchitektov/" target="_blank" class="block">Instagram</a>
        <a href="https://issuu.com/institutska" target="_blank" class="block">ISSUU</a>
    </x-footer.footer-navigation-column>
</nav>
