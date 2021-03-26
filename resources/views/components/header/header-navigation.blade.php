<nav>
    <button type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
    </button>

    <div id="navbar1">
        <ul>
            <li class="{{ Route::is('posts.*') ? 'active' : '' }}">
                <a href="{{ route('posts.index') }}">Aktuality</a>
            </li>
            <li>
                <a href="#">Register diel</a>
            </li>
            <li>
                <a href="#">Zoznamy architektov</a>
            </li>
            <li>
                <a href="#">Súťaže</a>
            </li>
            <li>
                <a href="#">CE ZA AR</a>
            </li>
            <li>
                <a href="#">ISKA</a>
            </li>
            <li>
                <a href="#">Kontakt</a>
            </li>
        </ul>
    </div>
    @include('components.langswitch')

    <div id="navbar2">
        <ul>
            @foreach (\App\Models\Page::topMenu()->get() as $page)
            <li>
                <a href="{{ $page->url }}">{{ $page->title }}</a>
            </li>
            @endforeach
        </ul>
        <form action="{{ route('search') }}">
            <input type="search" name="query" placeholder="Hľadať..." aria-label="Hľadať...">
        </form>
    </div>
</nav>
