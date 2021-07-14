@extends('layouts.app')
@section('title', $page->title)

<x-og :title="$page->title"
      :description="$page->short_description"
      :url="$page->url"
      :image="$page->cover_image"
></x-og>

@section('content')

<x-header.header></x-header.header>

<div class="container mx-auto px-6">

    <div id="nav-submenu" class="md:flex">
        @foreach ($page->breadcrumbs as $i => $breadcrumb)
            <div class="md:mr-16 lg:mr-24 mb-7 md:mb-0">
                <x-header.header-navigation-list :items="$breadcrumb->children" />
            </div>
        @endforeach
    </div>

    <x-intro
        :title="$page->title"
        text="“{{ __('app.intro') }}”"
    />
    <x-page.page-header :page="$page"></x-page.page-header>
    <x-page.page-content :page="$page"></x-page.page-content>
</div>

<x-footer.footer></x-footer.footer>

@stop
