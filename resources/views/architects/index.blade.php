@extends('layouts.app')
@section('title',  __('architects.title'))

@section('content')

@include('components.header.header')

<div class="container mx-auto px-6">
    <x-intro
        :title="trans('architects.title')"
        text="“{{ __('app.intro') }}”"
    />
    <architects-overview
        :authorization-labels="{{ json_encode( __('architects.authorizations')) }}"
    />
</div>

<x-footer.footer></x-footer.footer>

@endsection
