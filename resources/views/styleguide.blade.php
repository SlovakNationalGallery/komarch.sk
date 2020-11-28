@extends('layouts.app')

@section('title')
    Style Guide
    @parent
@endsection

@section('content')
    <p class='tmp'>Styleguide, mate!</p>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ mix('/css/styleguide.css') }}">
@endpush

@push('scripts')
    <script type="text/javascript" src="/js/styleguide.js"></script>
@endpush
