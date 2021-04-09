<a
    href="{{ $url }}"
    class="group block leading-loose {{ (url()->current() == $url) ? 'text-blue' : '' }}"
>
    {{ $slot }}
    <span class="opacity-0 inline-block transform group-hover:opacity-100 group-hover:translate-x-4 duration-200">
        →
    </span>
</a>
