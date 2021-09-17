<footer class="container mx-auto px-6 py-20 mt-20">
    {{-- <x-footer.footer-newsletter></x-footer.footer-newsletter> --}}
    <x-footer.footer-navigation
        :navigation="[
            'title' => 'Rýchle odkazy',
            'navItems' => [
                ['title' => 'Kontakty na úrady', 'url' => '/urad'],
                ['title' => 'Časté otázky', 'url' => '/najcastejsie-otazky'],
                ['title' => 'Ako podať disciplinárny podnet', 'url' => '/ako-podat-disciplinarny-podnet'],
                ['title' => 'Právne poradenstvo', 'url' => '/ako-podat-disciplinarny-podnet'],
                ['title' => 'Činnosť SKA', 'url' => '/vykon-povolania'],
            ]
        ]"
        :openingTimes="[
            'title' => 'Úradné hodiny',
        ]"
    ></x-footer.footer-navigation>
</footer>
