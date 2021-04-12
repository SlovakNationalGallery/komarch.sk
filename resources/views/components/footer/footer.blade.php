<footer class="container mx-auto px-4 py-20 mt-20">
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
        :openingTimes="[
            'title' => 'Úradné hodiny',
            'text' => '(Práve teraz máme otvorené)',
            'days' => [
                ['title' => 'Pondelok', 'times' => '08:00 - 12:00 &nbsp;&nbsp; 13:00 - 16:00'],
                ['title' => 'Utorok', 'times' => '08:00 - 12:00 &nbsp;&nbsp; 13:00 - 16:00'],
                ['title' => 'Streda', 'times' => '08:00 - 12:00 &nbsp;&nbsp; 13:00 - 16:00'],
                ['title' => 'Štvrtok', 'times' => '08:00 - 12:00 &nbsp;&nbsp; 13:00 - 16:00'],
                ['title' => 'Piatok', 'times' => 'Nestránkový deň'],
            ]
        ]"
    ></x-footer.footer-navigation>
</footer>
