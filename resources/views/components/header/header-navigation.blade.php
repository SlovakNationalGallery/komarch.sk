<nav class="border rounded-2xl md:border-0 md:flex-1 mt-6 md:mt-10 lg:mt-0">
    <navigation-toggle></navigation-toggle>
    <div
        id="nav-content"
        class="nav-menu px-4 md:px-0 md:flex"
    >
        <div class="flex-1 lg:ml-32">
            @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
            @include('components.header.header-navigation-search')
        </div>
        <div class="flex-1 md:ml-24 lg:ml-24 pb-4">
            @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
        </div>
    </div>
</nav>
