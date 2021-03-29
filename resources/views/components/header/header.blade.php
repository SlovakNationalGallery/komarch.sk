<header class="container mx-auto px-4 py-12 md:flex">
    @include('components.header.header-logo')
    @include('components.header.header-navigation', [
        'navigation_items_1' => [
            ['title' => 'O Komore', 'url' => '/'],
            ['title' => 'Autorizácia a členstvo', 'url' => '/test'],
            ['title' => 'Výkon a podpora povolania', 'url' => '/test'],
            ['title' => 'Právne dokumenty', 'url' => '/test'],
            ['title' => 'Verejná správa', 'url' => '/test'],
        ],
        'navigation_items_2' => [
            ['title' => 'Informácie SKA', 'url' => '/test'],
            ['title' => 'Register diel', 'url' => '/test'],
            ['title' => 'Zoznam architektov', 'url' => '/test'],
            ['title' => 'Súťaže', 'url' => '/test'],
            ['title' => 'CE ZA AR', 'url' => '/test'],
            ['title' => 'ISKA', 'url' => '/test'],
            ['title' => 'Kontakt', 'url' => '/test'],
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
