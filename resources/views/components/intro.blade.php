<div class="my-10 md:my-24">
    @isset($title)
        <h1 class="text-xl tracking-tight leading-tight text-left">{{ $title }}</h1>
    @endisset
    @isset($text)
        <p class="text-lg md:text-xl tracking-tight leading-tight text-left mt-8">{{ $text }}</p>
    @endisset
</div>
