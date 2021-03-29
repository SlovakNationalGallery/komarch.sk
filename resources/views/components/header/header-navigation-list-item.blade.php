<a
    href="{{ $item['url'] }}"
    class="group block leading-loose flex {{ Request::is($item['url']) ? 'text-blue' : '' }}"
>
    {{ $item['title'] }}
    <span class="opacity-0 transform group-hover:opacity-100 group-hover:translate-x-4 duration-200">
        →
    </span>
</a>

