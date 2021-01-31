@extends('layouts.app')
@section('title', 'vyhľadávanie')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 py-4">
            <ul>
                @foreach($posts as $post)
                    @include('posts._partials.listItem')
                @endforeach
            </ul>
        </div>

        {{-- XXX: links() also generates the "query" query param. Can we not? --}}
        {{ $posts->withQueryString()->links() }}
    </div>
    </div>
</div>
@endsection

