<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield('page_description', __('app.description'))">

    <title>
      @hasSection('title')
        @yield('title') | {{__('app.title')}}
      @else
        {{__('app.title')}}
      @endif
    </title>

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
  </head>

  <body>
    <div id="app">
      <main role="main">
        @include('components.langswitch')
        @yield('content')
      </main>
    </div>

    <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
  </body>
</html>
