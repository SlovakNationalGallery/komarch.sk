<header class="container mx-auto p-4 flex">
    @include('components.header.header-logo')
    @include('components.header.header-navigation', [
        'navigation_items_1' => [
            ['title' => 'Informácie SKA', 'url' => '#'],
            ['title' => 'Register diel', 'url' => '#'],
            ['title' => 'Zoznam architektov', 'url' => '#'],
            ['title' => 'Súťaže', 'url' => '#'],
            ['title' => 'CE ZA AR', 'url' => '#'],
            ['title' => 'ISKA', 'url' => '#'],
            ['title' => 'Kontakt', 'url' => '#'],
        ],
        'navigation_items_2' => [
            ['title' => 'Informácie SKA', 'url' => '#'],
            ['title' => 'Register diel', 'url' => '#'],
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
