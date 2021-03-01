@if(!isset($published_at))
    Draft
@else
    {!! $published_at->format('d. m. Y') !!}
@endif
