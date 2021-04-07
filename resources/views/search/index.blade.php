@extends('layouts.app')
@section('title', 'vyhľadávanie')

@section('content')

@include('components.header.header')

<div class="container">
    <div class="row">
        <div class="col-md-12 d-flex justify-content-between align-items-center pt-5">
            <h1 class="mb-3">Povedzte nám, čo hľadáte?</h1>
            <a href="{{ route('search') }}">Zrušiť vyhľadávanie</a>
        </div>

        <div class="col-md-12">
            <form action="{{ route('search') }}" method="GET">
                <input id="query"
                       name="query"
                       type="text"
                       placeholder="Hľadať..."
                       class="form-control form-control-lg"
                       value="{{ $query }}" aria-describedby="commonPhrases" />
                <small id="commonPhrases" class="form-text text-muted">
                  Často hľadané:
                    <a href="{{ route('search', ['query' => 'Zoznam architektov']) }}" class="btn btn-sm btn-link">Zoznam architektov</a>
                    <a href="{{ route('search', ['query' => 'Licenčná zmluva']) }}" class="btn btn-sm btn-link">Licenčná zmluva</a>
                    <a href="{{ route('search', ['query' => 'Autorizovaný architekt']) }}" class="btn btn-sm btn-link">Autorizovaný architekt</a>
                </small>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 py-5">
            <h4>Novinky o činnosti ({{ $posts->total() }})</h4>
            <ul class="px-0">
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
