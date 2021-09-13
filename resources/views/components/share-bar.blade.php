<div class="hidden lg:flex ml-auto justify-center mt-12 lg:mt-0">
    <a
        class="group w-20 flex justify-center items-center hover:text-blue"
        href="mailto:?to=&body={{ Request::url() }}"
        target="_blank"
    >
        <span class="group-hover:hidden text-lg icon-mail"></span>
        <span class="hidden group-hover:block">{{ __('sharing.share_mail')}}</span>
    </a>
    <button-copy
        copy-text="{{ __('sharing.share_copy') }}"
        copied-text="{{ __('sharing.share_copied') }}"
        copy-content="{{ Request::url() }}"
    ></button-copy>
    <a
        class="group w-20 flex justify-center items-center hover:text-blue"
        href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}"
        target="_blank"
    >
        <span class="group-hover:hidden text-lg icon-share"></span>
        <span class="hidden group-hover:block">{{ __('sharing.share_facebook')}}</span>
    </a>
</div>
