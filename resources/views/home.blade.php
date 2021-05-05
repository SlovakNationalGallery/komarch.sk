@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-4">
    <x-intro text="Slovenská Komora Architektov je odbornou organizáciou, ktorá sa zameriava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry"/>

    <div class="mt-10 md:mt-32 md:grid grid-cols-2 gap-10">
        <div class="flex" style="height: 300px">
            <span class="m-auto">Clock here</span>
        </div>
        @foreach ($tiles as $tile)
            <x-tile
            :title="$tile->title"
            :url="$tile->url"
        />
        @endforeach
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

    <x-section-map
        title="Register diel"
        titleUrl="#"
        mapUrl="#"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
