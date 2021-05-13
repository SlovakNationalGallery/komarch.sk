@section('og')
    <meta property="og:title" content="{{ $post->title }}"/>
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Slovenská komora architektov" />
    <meta property="og:description" content="{{ $post->perex }}"/>
    <meta property="og:url" content="{{ $post->url }}"/>
    <!-- TODO: ask for an OG image -->
    <!--    <meta property="og:image" content="{{ Request::url() }}"/>-->
@stop
