<a
    href="{{ $url }}"
    class="group block leading-loose flex {{ Request::is($url) ? 'text-blue' : '' }}"
>
    {{ $slot }}
    <span class="opacity-0 transform group-hover:opacity-100 group-hover:translate-x-4 duration-200">
        →
    </span>
</a>
