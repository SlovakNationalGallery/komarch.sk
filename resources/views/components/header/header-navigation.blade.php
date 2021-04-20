<nav class="border rounded-2xl md:border-0 md:flex-1 mt-6 md:mt-10 lg:mt-10">
    <navigation-toggle></navigation-toggle>
    <div
        id="nav-content"
        class="nav-menu px-4 md:px-0 md:flex"
    >
        <div class="flex-1 lg:ml-40">
            <x-header.header-navigation-list :items="$navItems1" />
            <x-header.header-navigation-search />
        </div>
        <div class="flex-1 md:ml-24 lg:ml-16 pb-4">
            <x-header.header-navigation-list :items="$navItems2" />
        </div>
    </div>
</nav>
