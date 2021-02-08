@php
    $breadcrumbs = data_get($entry, $column['name']);
@endphp

@if(!isset($breadcrumbs))
    None
@else
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent p-0 justify-content-start">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url)
                <li class="breadcrumb-item text-capitalize"><a href="{{ $breadcrumb->url }}" target="_blank">{{ $breadcrumb->title }}</a></li>
            @else
                <li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
      </ol>
    </nav>
@endif