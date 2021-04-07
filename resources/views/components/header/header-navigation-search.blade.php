<form action="{{ route('search') }}" class="my-5 flex align-center">
    <input
        type="search"
        name="query"
        placeholder="Architekt / architektka, dielo, dokument, iné ..."
        aria-label="Hľadať..."
        class="border-b border-gray-900 w-full outline-none text-sm"
    >
    <span class="icon-search ml-1"></span>
</form>
