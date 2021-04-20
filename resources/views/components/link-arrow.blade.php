<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => 'group block leading-loose hover:text-blue']) }}
>
    {{ $slot }}
    <span class="inline-block transform group-hover:translate-x-2 duration-200">
        →
    </span>
</a>
