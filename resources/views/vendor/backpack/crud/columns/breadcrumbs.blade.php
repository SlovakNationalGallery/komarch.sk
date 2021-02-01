@if(!isset($published_at))
    None
@else
    @foreach ($breadcrumbs as $i=>$breadcrumb)
        <li class="breadcrumb-item {{ ($i == (count($breadcrumbs)-1) ) ? 'active' : ''}}"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->name }}</a></li>
    @endforeach
@endif