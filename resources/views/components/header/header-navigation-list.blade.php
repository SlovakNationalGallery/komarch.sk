<ul>
    @foreach ($items as $item)
        <li>
            <x-link-arrow :link="$item" />
        </li>
    @endforeach
</ul>
