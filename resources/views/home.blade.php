@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header')

@include('components.notification_bar')

<div class="container">
    <div class="row py-5">
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
    <div class="row py-5 border-top">
        @if ($featured_post)
            <div class="col-md-4">
                @include('components.article-big', ['post' => $featured_post])
            </div>
        @endif
        <div class="col-md-4">
            @foreach($posts as $post)
                @include('components.article-small', ['post' => $post])
            @endforeach

            <div class="mt-2">
                <a href="{{ route('posts.index') }}">Viac noviniek →</a>
            </div>

        </div>
        <div class="col-md-4">
            <h5 class="display-5">Najnovšie publikácie</h5>
            <div class="text-center">
                <img src="https://placekitten.com/150/200" class="img-fluid my-3 mx-auto" />
            </div>
        </div>


    </div>
</div>
@endsection

