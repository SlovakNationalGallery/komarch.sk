<a
    href="{{ $link['url'] }}"
    class="group block leading-loose flex {{ (url()->current() == $link['url']) ? 'text-blue' : '' }}"
>
    {{ $link['title'] }}
    <span class="opacity-0 transform group-hover:opacity-100 group-hover:translate-x-4 duration-200">
        →
    </span>
</a>
