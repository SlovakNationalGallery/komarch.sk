@extends('layouts.app')
@section('title', 'správy')

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

        {{ $posts->withQueryString()->links() }}
    </div>
    </div>
</div>
@endsection

