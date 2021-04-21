<ul>
    @foreach ($items as $item)
        <li>
            <x-link-arrow-hover :url="$item['url']">
                {{ $item['title'] }}
            </x-link-arrow-hover>
        </li>
    @endforeach
</ul>
