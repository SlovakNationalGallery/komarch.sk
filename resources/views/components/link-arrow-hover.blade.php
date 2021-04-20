@php
    $class = 'group block leading-loose hover:text-blue';
    $class .= (url()->current() == $url) ? 'text-blue' : '';
@endphp
<a
    href="{{ $url }}"
    {{ $attributes->merge(['class' => $class]) }}
>
    {{ $slot }}
    <span class="opacity-0 inline-block transform group-hover:opacity-100 group-hover:translate-x-3 duration-200">
        {{ $external ?? false ? '→' : '->' }}
    </span>
</a>
