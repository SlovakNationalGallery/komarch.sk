@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

@include('components.notification_bar')

<div class="container mx-auto px-4">
    <div class="row py-5">
        <x-intro
            title="Podporujeme rozvoj architektúry na Slovensku"
            text="Slovenská Komora Architektov je odbornou organizáciou, ktorá sa zameriava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry"
        />

        <div class="mt-10">
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
        <div>
            @include('components.tile', [
                'title' => 'Potrebujete pomôcť s vyhlasovaním súťaže?',
                'text' => 'Radi vám pomôžeme',
                'url' => '#',
            ])
            @include('components.tile', [
                'title' => 'Lorem ipsum dolor sit amet, consectur adipiscing',
                'text' => 'Lorem ipsum dolor',
                'url' => '#',
            ])
        </div>
    <div>

            <h5>Súťaže</h5>
            <ul>
                <li>
                    <a href="#">Ukončené</a>
                </li>
                <li>
                    <a href="#">Prebiehajúce</a>
                </li>
                <li>
                    <a href="#">Pripravované</a>
                </li>
            </ul>

            <div>
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
    <div>
        @if ($featured_post)
            <div>
                @include('components.article-big', ['post' => $featured_post])
            </div>
        @endif
        <div>
            @foreach($posts as $post)
                @include('components.article-small', ['post' => $post])
            @endforeach

            <div>
                <a href="{{ route('posts.index') }}">Viac noviniek →</a>
            </div>

        </div>
        <div>
            <h5>Najnovšie publikácie</h5>
            <div>
                <img src="https://placekitten.com/150/200" />
            </div>
        </div>

    </div>
</div>
@endsection

