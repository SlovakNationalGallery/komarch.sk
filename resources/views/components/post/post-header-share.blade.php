<a
    class="group w-20 flex justify-center items-center hover:text-blue ml-auto"
    href="mailto:?to=&body={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden text-xl icon-mail"></span>
    <span class="hidden group-hover:block">{{ __('post.share_mail')}}</span>
</a>
<a class="group w-20 flex justify-center items-center cursor-pointer hover:text-blue">
    <span class="group-hover:hidden text-xl icon-link"></span>
    <span class="hidden group-hover:block">{{ __('post.share_copy')}}</span>
</a>
<a
    class="group w-20 flex justify-center items-center hover:text-blue"
    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden text-xl icon-share"></span>
    <span class="hidden group-hover:block">{{ __('post.share_facebook')}}</span>
</a>
