@extends('layouts.app')
@section('title', $page->title)

@section('content')

@include('components.header.header')

<div class="container">
    <div class="row">
        <div class="col-12 py-4">

            <nav aria-label="breadcrumb" class="d-none d-lg-block">
              <ol class="breadcrumb bg-transparent p-0 justify-content-start">
                @foreach ($page->breadcrumbs as $breadcrumb)
                    @if ($breadcrumb->url)
                        <li class="breadcrumb-item text-capitalize"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item text-capitalize active" aria-current="page">{{ $breadcrumb->title }}</li>
                    @endif
                @endforeach
              </ol>
            </nav>

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
