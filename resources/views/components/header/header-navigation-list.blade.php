<ul>
    @foreach ($navigation_items as $item)
        @include('components.header.header-navigation-list-item', $item)
    @endforeach
</ul>
