@extends('layouts.app')
@section('title', 'správy')

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-4">
    <x-article.article-back :post="$post"></x-article.article-back>
    <x-article.article-header :post="$post"></x-article.article-header>
    <x-article.article-content :post="$post"></x-article.article-content>
    <x-article.article-related :post="$post"></x-article.article-related>
</div>

<x-footer.footer></x-footer.footer>

@endsection
