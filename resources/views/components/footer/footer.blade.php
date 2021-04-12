<footer class="container mx-auto px-4 py-20">
    <x-footer.footer-newsletter></x-footer.footer-newsletter>
    <x-footer.footer-navigation
        :navigation="[
            'title' => 'Rýchle odkazy',
            'navItems' => [
                ['title' => 'Kontakty na úrady', 'url' => '/'],
                ['title' => 'Časté otázky', 'url' => '/test'],
                ['title' => 'Ako podať disciplinárny podnet', 'url' => '/test'],
                ['title' => 'Právne poradenstvo', 'url' => '/test'],
                ['title' => 'Činnosť SKA', 'url' => '/test'],
            ]
        ]"
    ></x-footer.footer-navigation>
</footer>
