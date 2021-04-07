<header class="container mx-auto px-4 py-6 md:py-12 lg:flex lg:items-start">
    <x-header.header-logo />
    <x-header.header-navigation
        :navItems1="[
            ['title' => 'O Komore', 'url' => '/'],
            ['title' => 'Autorizácia a členstvo', 'url' => '/test'],
            ['title' => 'Výkon a podpora povolania', 'url' => '/test'],
            ['title' => 'Právne dokumenty', 'url' => '/test'],
            ['title' => 'Verejná správa', 'url' => '/test'],
        ]"
        :navItems2="[
            ['title' => 'Informácie SKA', 'url' => '/test'],
            ['title' => 'Register diel', 'url' => '/test'],
            ['title' => 'Zoznam architektov', 'url' => '/test'],
            ['title' => 'Súťaže', 'url' => '/test'],
            ['title' => 'CE ZA AR', 'url' => '/test'],
            ['title' => 'ISKA', 'url' => '/test'],
            ['title' => 'Kontakt', 'url' => '/test'],
        ]"
    />
</header>

<!--    <ul>-->
<!--        @foreach (\App\Models\Page::topMenu()->get() as $page)-->
<!--        <li>-->
<!--            <a href="{{ $page->url }}">{{ $page->title }}</a>-->
<!--        </li>-->
<!--        @endforeach-->
<!--    </ul>-->
