@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

{{-- @include('components.notification_bar') --}}

<div class="container mx-auto px-6">
    <x-intro :text="trans('home.intro')"/>

    <div class="mt-10 md:mt-32 md:grid grid-cols-2 gap-10">
        <div style="height: 300px">
            {{-- <img src="{{ asset('images/clock.svg') }}" alt="clock" class="mb-5"> --}}
            <div class="mb-3 md:mb-5" style="height: 200px">
                <Clock />
            </div>

            <x-link-arrow url="#">
                3 dni a 11 hodín do odovzdania návrhov na predĺženie promenády na Železnej studienke
            </x-link-arrow>
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
            <filter-listing-tenders
                :options="{{ json_encode($contestFilterOptions) }}"
            />
        </div>
        <div class="flex-1 md:mr-14">
            <filter-listing-posts />
        </div>
        <div class="flex-1">
            <x-section-videos
                title="Videá"
                embedUrl="https://www.youtube.com/embed/NL1XKbI3x68"
                linkUrl="#"
                :linkTitle="trans('home.more_video')"
            />
            <x-section-publications
                title="Publikácie"
                :publications="$publications"
                linkUrl="#"
                :linkTitle="trans('home.read_on_issuu')"
            />
        </div>
    </div>

    <x-section-map
        worksUrl="{{ route('works') }}"
        mapUrl="#"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
