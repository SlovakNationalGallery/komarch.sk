@extends('layouts.app')
@section('title', $post->title)

@section('content')

@include('components.header')

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="d-none d-lg-block">
              <ol class="breadcrumb bg-transparent p-0 justify-content-start">
                @foreach ($breadcrumbs as $title=>$url)
                    @if ($url)
                        <li class="breadcrumb-item"><a href="{{ $url }}">{{ $title }}</a></li>
                    @else
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    @endif
                @endforeach
              </ol>
            </nav>
        </div>
    </div>
    <div class="row justify-content-md-center">
        <div class="col-md-8 py-4">
            <h1>{{ $post->title }}</h1>

            <div class="d-flex align-items-center text-secondary">
                @include('components.tags', ['tags' => $post->tags])
                <div class="px-2">·</div>
                <div>
                    @include('components.published_at', ['published_at' => $post->published_at])
                </div>
                @if (isSet($post->published_at) && $post->published_at->age > 0)
                    <span class="badge badge-warning ml-2 p-2">Viac ako 1 rok starý</span>
                @endif
            </div>

            <div class="pt-4 post-content">
                {!! nl2br($post->text) !!}
            </div>

            <div class="pt-4">
                @include('components.tags', ['tags' => $post->tags])
            </div>
        </div>
    </div>
</div>
@endsection
