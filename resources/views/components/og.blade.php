@section('og')
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ __('app.title') }}" />
    <meta property="og:description" content="{{ $description }}"/>
    <meta property="og:url" content="{{ $url }}"/>
    @if ($attributes->has('image') && !is_null($image))
        <meta property="og:image" content="{{ $image->getFullUrl() }}"/>
    @endif
@stop
