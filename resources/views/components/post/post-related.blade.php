@if (count($related) > 0)
    <section class="mt-20">
        <h2 class="text-xl mb-10">{{ __('post.related') }}</h2>
        <swiper-posts :posts="{{ json_encode($related) }}"></swiper-posts>
    </section>
@endif
