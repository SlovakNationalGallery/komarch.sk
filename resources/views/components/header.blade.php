<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('home') }}">S K A</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar1">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item {{ Route::is('posts.*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('posts.index') }}">Aktuality</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Register diel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Zoznamy architektov</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Súťaže</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">CE ZA AR</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">ISKA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Kontakt</a>
        </li>
      </ul>
    </div>
    @include('components.langswitch')
  </div>
</nav>

<nav class="navbar navbar-expand navbar-light bg-light border-top border-bottom">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbar2">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        @foreach (\App\Models\Page::topMenu()->get() as $page)
          <li class="nav-item">
            <a class="nav-link" href="{{ $page->url }}">{{ $page->title }}</a>
          </li>
        @endforeach
      </ul>
      <form class="form-inline my-2 my-lg-0 ml-2" action="{{ route('search') }}">
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Hľadať..." aria-label="Hľadať...">
      </form>
    </div>
  </div>
</nav>