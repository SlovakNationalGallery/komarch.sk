<nav class="flex">
    <x-footer.footer-navigation-column :title="$navigation['title']">
        <ul class="mt-10">
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
        <a href="mailto:komarch@komarch.sk" target="_blank">komarch@gomarch.sk</a>
        <a href="tel:+421254432080" target="_blank">+ 421 254 432 080</a>
        <a href="tel:+421254432254" target="_blank">+ 421 254 432 254</a>
        <a href="facebook.com" target="_blank">Facebook</a>
        <a href="instagram.com" target="_blank">Instagram</a>
        <a href="ISSU.com" target="_blank">ISSUU</a>
    </x-footer.footer-navigation-column>
</nav>
