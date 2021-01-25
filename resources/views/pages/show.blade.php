@extends('layouts.app')
@section('title', $page->title)

@section('content')

@include('components.header')

<div class="container">
    <div class="row">
        <div class="col-12 py-4">
            <h1>{{ $page->title }}</h1>

            <div class="text-grey-darker text-sm pb-6 border-b text-grey">
                {{ $page->published_at }} | {{ $page->author }}
            </div>

            <div class="pt-4 page-content">
                {!! $page->text !!}
            </div>

            <div class="pt-4">
                @include('components.tags', ['tags' => $page->tags])
            </div>
        </div>
    </div>
</div>
@endsection
