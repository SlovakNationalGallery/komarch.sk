<div {{ $attributes->merge(['class' => 'group relative border-t border-black pt-12 pb-16 h-56 flex justify-center items-center md:justify-start md:items-stretch md:h-80 md:pt-8 md:pb-12 hover:bg-blue hover:border-blue transition duration-100']) }}>
    <h3 class="text-2xl text-center tracking-tight md:text-3xl md:text-left leading-snug px-5 group-hover:text-white transition duration-100">
        <a href="{{ $url }}" class="block link-area ligatures">
            {{ $title }} <span class="icon-arrow-r-long"></span>
        </a>
    </h3>
</div>
