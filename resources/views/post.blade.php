@extends('layouts.app')
@section('title', 'správy')

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-4">
    <x-post.post-back :post="$post"></x-post.post-back>
    <x-post.post-header :post="$post"></x-post.post-header>
    <x-post.post-content :post="$post"></x-post.post-content>
    <x-post.post-related :post="$post"></x-post.post-related>
</div>

<x-footer.footer></x-footer.footer>

@endsection
