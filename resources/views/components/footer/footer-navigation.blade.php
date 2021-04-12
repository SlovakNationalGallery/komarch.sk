<nav class="flex flex-col-reverse md:flex-row text-lg md:text-base">
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
                <td class="w-20">Pon.</td><td class="w-16">8-12</td><td>13-16</td>
            <tr>
            <tr>
                <td>Ut.</td><td>8-12</td><td>13-16</td>
            </tr>
            <tr>
                <td>Str.</td><td>8-12</td><td>13-16</td>
            </tr>
            <tr>
                <td>Štv.</td><td>8-12</td><td>13-16</td>
            </tr>
            <tr>
                <td>Pia.</td><td colspan="2">Nestránkový deň</td>
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
