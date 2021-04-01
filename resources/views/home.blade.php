@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

@include('components.notification_bar')

<div class="container mx-auto px-4">
    <x-intro
        title="Podporujeme rozvoj architektúry na Slovensku"
        text="Slovenská Komora Architektov je odbornou organizáciou, ktorá sa zameriava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry"
    />

    <div class="lg:flex">
        <div class="flex-1 mt-20 md:mr-4">
            <filter-listing-tenders />
        </div>
        <div class="flex-1 mt-20 md:mr-4">
            <filter-listing-ska />
        </div>
        <div class="flex-1 mt-20 md:mr-4">
            <x-heading-section>
                Videá
            </x-heading-section>
        </div>
    </div>

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
