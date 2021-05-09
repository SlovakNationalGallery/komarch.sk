<!-- TODO: add share icons when they get added to the font -->
<a
    class="group ml-auto w-20 flex justify-center hover:text-blue"
    href="mailto:?to=&body={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden icon-mail"></span>
    <span class="hidden group-hover:block">{{ __('post.share_mail')}}</span>
</a>
<a class="group w-20 flex justify-center cursor-pointer hover:text-blue">
    <span class="group-hover:hidden icon-link"></span>
    <span class="hidden group-hover:block">{{ __('post.share_copy')}}</span>
</a>
<a
    class="group w-20 flex justify-center hover:text-blue"
    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden icon-share"></span>
    <span class="hidden group-hover:block">{{ __('post.share_facebook')}}</span>
</a>
