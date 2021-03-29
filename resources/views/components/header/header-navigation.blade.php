<nav class="px-4 pb-4 border rounded-2xl md:border-0 md:flex-1 md:flex md:pl-20 md:mt-10">
    <navigation-toggle></navigation-toggle>
    @include('components.header.header-navigation-toggle')
    <div class="flex-1 md:mx-10">
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_1])
        @include('components.header.header-navigation-search')
    </div>
    <div class="flex-1 md:mx-10">
        @include('components.header.header-navigation-list', ['navigation_items' => $navigation_items_2])
    </div>
</nav>
