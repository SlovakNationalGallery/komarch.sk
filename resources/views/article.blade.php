@extends('layouts.app')
@section('title', 'správy')

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-4">
    <x-article.article-back></x-article.article-back>
    <x-article.article-header></x-article.article-header>
    <x-article.article-content></x-article.article-content>
    <x-article.article-related></x-article.article-related>
</div>

<x-footer.footer></x-footer.footer>

@endsection
