<nav class="md:flex md:flex-1 md:pl-20 md:mt-10">
    <div class="flex-1 md:mx-10">
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
        @include('components.header.header-navigation-search')
    </div>
    <div class="flex-1 md:mx-10">
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
    </div>
</nav>
