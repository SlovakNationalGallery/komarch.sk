<header class="container mx-auto px-4 py-6 md:py-12 lg:flex lg:items-start">
    <x-header.header-logo />
    <x-header.header-navigation
        :navItems="\App\Models\Page::topMenu()->get()"
    />
    <x-header.header-langswitch />
</header>
