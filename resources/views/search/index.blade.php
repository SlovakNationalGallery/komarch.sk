@extends('layouts.app')
@section('title', 'vyhľadávanie')

@section('content')

@include('components.header')

<div class="container">
    <h1 class="col-12">Povedzte nám, čo hľadáte</h1>

    <div class="col-12">
        <form action="/search" method="GET">
        <input id="query"
               name="query"
               type="text"
               placeholder="Zoznam architektov"
               value="{{ $query }}" />
        </form>
    </div>

    <div class="row">
        <div class="col-12 py-4">
            <ul>
                @foreach($posts as $post)
                    @include('search._partials.item')
                @endforeach
            </ul>
        </div>

        {{ $posts->withQueryString()->links() }}
    </div>
    </div>
</div>

@endsection
