<nav class="flex">
    <div>
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
        @include('components.header.header-navigation-search')
    </div>
    @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
</nav>
