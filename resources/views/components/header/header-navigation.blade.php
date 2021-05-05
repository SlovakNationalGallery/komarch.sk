<nav class="border rounded-2xl md:border-0 md:flex-1 mt-6 md:mt-10 lg:mt-10">
    <navigation-toggle></navigation-toggle>
    <div
        id="nav-content"
        class="nav-menu px-4 md:px-0 md:flex"
    >
        @foreach($navItems->split(2) as $i=>$items)
            <div class="flex-1 {{ ($i==0) ? 'lg:ml-40' : 'md:ml-24 lg:ml-16'}}">
                <x-header.header-navigation-list :items="$items" />
                @if ($i==0)
                    <x-header.header-navigation-search />
                @endif
            </div>
        @endforeach
    </div>
</nav>
