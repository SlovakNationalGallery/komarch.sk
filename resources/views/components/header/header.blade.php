<header class="container mx-auto px-6 py-6 md:py-12 lg:flex lg:items-start">
    <x-header.header-logo />
    <x-header.header-navigation
        :navItems1="\App\Models\Page::topMenu()->get()"
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
    <x-header.header-langswitch />
</header>
