<nav class="md:flex md:flex-1 md:justify-around lg:px-20 lg:mr-20">
    <div>
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
        @include('components.header.header-navigation-search')
    </div>
    @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
</nav>