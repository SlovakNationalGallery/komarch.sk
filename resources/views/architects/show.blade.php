@extends('layouts.app')

@section('title')
{{ $contest->title }}
@stop

<x-og :title="$contest->title"
      :description="$contest->perex"
      :url="$contest->url"
></x-og>

@section('content')
<x-header.header></x-header.header>
<div class="container mx-auto px-6">
    <x-contest.contest-back :contest="$contest"></x-contest.contest-back>
    <x-contest.contest-header :contest="$contest"></x-contest.contest-header>
    <x-contest.contest-content :contest="$contest"></x-contest.contest-content>
</div>
<x-footer.footer></x-footer.footer>
@stop
