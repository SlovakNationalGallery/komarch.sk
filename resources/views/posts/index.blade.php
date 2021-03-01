@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header')

<div class="container py-4">
    <div class="row">
        <div class="col-md-12 pb-4">
            <h1>Novinky o činnosti</h1>
            <p>Lorem ipsum minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3" id="filters">
            <div class="d-flex justify-content-between">
                <h5 class="display-5">Filter</h5>
                <div>
                    <a href="{{ route('posts.index') }}" class="link-underline text-dark">Zmazať filter</a>
                </div>
            </div>
            <form action="{{ route('posts.index') }}">
                <h6 class="mt-3">Kategória</h6>
                @foreach (\Spatie\Tags\Tag::all() as $tag)
                    @include('components.filter-checkbox', ['tag' => $tag])
                @endforeach
            </form>

            <h5 class="display-5 mt-5">Rýchle odkazy</h5>
            <ul class="list-unstyled">
                <li><a href="#">CE ZA AR 2020 →</a></li>
                <li><a href="#">Informácie o COVID 19 →</a></li>
                <li><a href="#">Lorem ipsum dolor sit amet →</a></li>
                <li><a href="#">Lorem ipsum dolor sit amet →</a></li>
            </ul>
        </div>
        <div class="col-md-9 border-left">

            <div class="d-flex justify-content-between pb-4 text-secondary">
                <div>Zobrazených {{ $posts->count() }} z {{ $posts->total() }}</div>
                <div>Zoradiť podľa: dátumu (od najnovších)</div>
            </div>

            <ul class="list-unstyled">
                @foreach($posts as $post)
                    @include('posts._partials.listItem')
                @endforeach
            </ul>

            <div class="text-center">
                {{ $posts->withQueryString()->links() }}
            </div>
        </div>

    </div>
    </div>
</div>
@endsection

