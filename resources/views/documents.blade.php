@extends('layouts.app')
@section('title', 'správy')

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        title="Právne dokumenty"
        text="“Podporujeme rozvoj architektúry na Slovensku. Sme odbornou organizáciou, ktorá sa zameri ava na vzdelávanie a informovanie verejnosti o potrebách kvalitnej architektúry.“"
    />
    <documents-overview />
</div>

<x-footer.footer></x-footer.footer>

@endsection
