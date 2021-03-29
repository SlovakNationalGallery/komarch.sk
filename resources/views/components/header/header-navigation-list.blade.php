<ul>
    @foreach ($items as $item)
        <li>
            <x-header.header-navigation-list-item :item="$item" />
        </li>
    @endforeach
</ul>
