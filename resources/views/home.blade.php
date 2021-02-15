@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header')

@include('components.notification_bar')

<div class="container py-5">
    <div class="row">
        <div class="col-md-8 border-right">
            <h1>Podporujeme rozvoj architektúry na&nbsp;Slovensku</h1>
            <p>Slovenská Komora Architektov je odbornou organizáciou, ktorá sa zameriava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry</p>

            <div class="card-deck mb-4">
                @include('components.tile', [
                    'title' => 'Ako sa stať autorizovaným členom?',
                    'text' => 'Pozrite ako na to',
                    'url' => '#',
                ])
                @include('components.tile', [
                    'title' => 'Hľadáte zoznam architektonických diel?',
                    'text' => 'Ukázať zoznam',
                    'url' => '#',
                ])
            </div>
            <div class="card-deck mb-4">
                @include('components.tile', [
                    'title' => 'Potrebujete pomôcť s vyhlasovaním súťaže?',
                    'text' => 'Radi vám pomôžeme',
                    'url' => '#',
                ])
                @include('components.tile', [
                    'title' => 'Lorem ipsum dolor sit amet, consectur
adipiscing',
                    'text' => 'Lorem ipsum dolor',
                    'url' => '#',
                ])
            </div>
        </div>
        <div class="col-md-4 ">

            <h5 class="display-5">Súťaže</h5>
            <ul class="nav justify-content-between">
                <li class="nav-item">
                    <a class="nav-link p-0 active" href="#">Ukončené</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-0" href="#">Prebiehajúce</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-0" href="#">Pripravované</a>
                </li>
            </ul>

            <div class="tenders mb-2">
                @for ($i = 0; $i < 4; $i++)
                    @include('components.tender-small', [
                        'date' => '11. 1. 2021 – 10. 12. 2020',
                        'text' => 'Výsledky krajinársko-urbanistickej súťaže Revitalizácia Mlynského náhonu v Košiciach',
                        'url' => '#',
                    ])
                @endfor
            </div>
            <div>
                <a href="#">Viac súťaží →</a>
            </div>
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

