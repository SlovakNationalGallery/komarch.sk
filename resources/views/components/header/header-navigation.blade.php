<nav class="border rounded-2xl md:border-0 mt-4 md:flex-1 md:mt-0">
    <navigation-toggle></navigation-toggle>
    <div id="nav-content" class="max-h-0 transition-all duration-500 overflow-hidden px-4 md:max-h-screen md:flex">
        <div class="flex-1 md:ml-24">
            @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
            @include('components.header.header-navigation-search')
        </div>
        <div class="flex-1 md:ml-24 pb-4">
            @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
        </div>
    </div>
</nav>
