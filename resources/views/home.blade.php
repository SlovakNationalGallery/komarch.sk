@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-4">
    <x-intro
        title="Podporujeme rozvoj architektúry na Slovensku"
        text="Slovenská Komora Architektov je odbornou organizáciou, ktorá sa zameriava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry"
    />

    <div class="mt-24 md:grid grid-cols-2 gap-10">
        <div class="flex" style="height: 300px">
            <span class="m-auto">Clock here</span>
        </div>
        <x-tile
            title="Ako sa stať autorizovaným členom"
            url="#"
        />
        <x-tile
            title="Ako sa stať autorizovaným členom"
            url="#"
        />
        <x-tile
            title="Ako sa stať autorizovaným členom"
            url="#"
        />
    </div>

    <div class="lg:flex">
        <div class="flex-1 md:mr-14">
            <filter-listing-tenders />
        </div>
        <div class="flex-1 md:mr-14">
            <filter-listing-ska />
        </div>
        <div class="flex-1">
            <x-section-videos
                title="Videá"
                embedUrl="https://www.youtube.com/embed/NL1XKbI3x68"
                linkUrl="#"
                linkTitle="Pozrite si ďalšie videá"
            />
            <x-section-publications
                title="Publikácie"
                imageUrl="https://placekitten.com/640/360"
                imageAlt="Kitten"
                linkUrl="#"
                linkTitle="Čítajte na ISSU"
            />
        </div>
    </div>

    <div class="mt-20">
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
