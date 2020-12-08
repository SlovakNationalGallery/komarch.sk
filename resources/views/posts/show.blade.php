@extends('layouts.app')
@section('title', $post->title)

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 py-4">
            <h1>{{ $post->title }}</h1>

            <div class="text-grey-darker text-sm pb-6 border-b text-grey">
                {{ $post->published_at }} | {{ $post->author }}
            </div>

            <div class="pt-4 post-content">
                {!! $post->text !!}
            </div>

            <div class="pt-4">
                @include('components.tags', ['tags' => $post->tags])
            </div>
        </div>
    </div>
</div>
@endsection
