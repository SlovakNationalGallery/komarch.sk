<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group block leading-relaxed hover:text-blue']) }}
>
    <span class="inline-block transform group-hover:-translate-x-2 duration-200 {{ $external ?? false ? 'icon-arrow-l' : 'icon-arrow-l-long' }}"></span>
    {{ $slot }}
</a>
