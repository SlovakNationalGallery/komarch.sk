@extends('layouts.app')
@section('title', 'vyhľadávanie')

@section('content')

<div class="container">
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

