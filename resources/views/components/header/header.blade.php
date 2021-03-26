<header class="container mx-auto px-4 py-12 md:flex">
    @include('components.header.header-logo')
    @include('components.header.header-navigation', [
        'navigation_items_1' => [
            ['title' => 'O Komore', 'url' => '#'],
            ['title' => 'Autorizácia a členstvo', 'url' => '#'],
            ['title' => 'Výkon a podpora povolania', 'url' => '#'],
            ['title' => 'Právne dokumenty', 'url' => '#'],
            ['title' => 'Verejná správa', 'url' => '#'],
        ],
        'navigation_items_2' => [
            ['title' => 'Informácie SKA', 'url' => '#'],
            ['title' => 'Register diel', 'url' => '#'],
            ['title' => 'Zoznam architektov', 'url' => '#'],
            ['title' => 'Súťaže', 'url' => '#'],
            ['title' => 'CE ZA AR', 'url' => '#'],
            ['title' => 'ISKA', 'url' => '#'],
            ['title' => 'Kontakt', 'url' => '#'],
        ]
    ])
</header>

<!--    <ul>-->
<!--        @foreach (\App\Models\Page::topMenu()->get() as $page)-->
<!--        <li>-->
<!--            <a href="{{ $page->url }}">{{ $page->title }}</a>-->
<!--        </li>-->
<!--        @endforeach-->
<!--    </ul>-->
