<a
    class="ml-auto w-20 flex items-center"
    href="mailto:?to=&body={{ Request::url() }}"
    target="_blank"
>
    <span>i-mail</span>
    <span class="hidden">Send</span>
</a>
<a class="ml-4 w-20 flex items-center cursor-pointer">
    <span>i-copy</span>
    <span class="hidden">Copy link</span>
</a>
<a
    class="ml-4 w-20 flex items-center"
    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
    target="_blank"
>
    <span>i-fb</span>
    <span class="hidden">Share</span>
</a>
