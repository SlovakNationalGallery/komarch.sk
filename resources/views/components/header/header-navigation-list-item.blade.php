<li class="{{ Route::is('posts.*') ? 'active' : '' }}">
    <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
</li>
