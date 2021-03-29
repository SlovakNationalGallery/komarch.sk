<ul>
    @foreach ($navigation_items as $item)
        <li>
            @include('components.header.header-navigation-list-item', $item)
        </li>
    @endforeach
</ul>
