<!-- TODO: add share icons when they get added to the font -->
<a
    class="group ml-auto w-20 flex justify-center hover:text-blue"
    href="mailto:?to=&body={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden">i-mail</span>
    <span class="hidden group-hover:block">Send</span>
</a>
<a class="group ml-4 w-20 flex justify-center cursor-pointer hover:text-blue">
    <span class="group-hover:hidden">i-copy</span>
    <span class="hidden group-hover:block">Copy link</span>
</a>
<a
    class="group ml-4 w-20 flex justify-center hover:text-blue"
    href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
    target="_blank"
>
    <span class="group-hover:hidden">i-fb</span>
    <span class="hidden group-hover:block">Share</span>
</a>
