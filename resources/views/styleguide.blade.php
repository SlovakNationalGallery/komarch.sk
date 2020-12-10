@extends('layouts.app')

@section('title')
  Style Guide
  @parent
@endsection

@section('content')

<main>
<h1>Style Guide</h1>

<div class="container">
<div class="row">
<section id="styleguide-branding" class="col m-1">
  <h2>Branding</h2>

  <h1 class="ls-2">Slovenská Komora Architektúry</h1>
  <!-- TODO: Icons and favicons -->
</section>

<section id="styleguide-colors" class="col m-1">
  <h2>Colors</h2>

  <div class="row">
    <div class="col m-2"><div id="styleguide-color-primary" class="styleguide-color"></div></div>
    <div class="col m-2"><div id="styleguide-color-secondary" class="styleguide-color"></div></div>
    <div class="col m-2"><div id="styleguide-color-success" class="styleguide-color"></div></div>
    <div class="col m-2"><div id="styleguide-color-info" class="styleguide-color"></div></div>
    <div class="col m-2"><div id="styleguide-color-warning" class="styleguide-color"></div></div>
  </div>
</section>
</div>

<div class="row">
<section id="styleguide-typography" class="col m-1">
  <h2>Typography</h2>
  <div class="cd-box">
    <h1>Heading, <span></span></h1>
    <p>Aa - <span></span>. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis voluptate distinctio reprehenderit, autem deleniti ad <a href="#0">voluptatum eaque</a>. Optio ea aperiam nisi distinctio nemo repellat, voluptate fugiat. Quidem neque illum, blanditiis!</p>
  </div>
</section>

<section id="styleguide-buttons" class="col m-1">
  <h2>Buttons</h2>

    <button class="btn btn-outline-dark">Outlined</button>
    <button class="btn btn-outline-dark btn-sm">Outlined sm</button>
    <button class="btn btn-outline-dark btn-sm btn-with-icon-right">Outlined sm with right icon<span>&times;</span></button>
</section>
</div>

<div class="row">
<section id="styleguide-icons" class="col m-1">
  <h2>Icons</h2>

  <ul>
    <li class="icon-menu" />
    <li class="icon-plus" />
    <li class="icon-check" />
    <li class="icon-close" />
    <li class="icon-search" />
    <li class="icon-arrow-down" />
    <li class="icon-arrow-up" />
    <li class="icon-chevron-right" />
    <li class="icon-chevron-left" />
    <li class="icon-cube" />
    <li class="icon-minus" />
    <li class="icon-fullscreen" />
    <li class="icon-chevron-up" />
    <li class="icon-chevron-down" />
  </ul>
</section>

<section id="styleguide-form" class="col m-1">
  <h2>Form</h2>

  <form>
    <fieldset>
      <input class="form-control  w-50" type="text" >
      <input class="form-control  w-50 is-valid" type="text">
      <input class="form-control  w-50 is-invalid" type="text">
    </fieldset>
   <fieldset>
      <div class="cd-input-wrapper">
        <div class="custom-control custom-radio">
          <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input" />
          <label class="custom-control-label" for="customRadio1">Toggle 1</label>
        </div>
      </div>
     <div class="cd-input-wrapper">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="customCheck1" />
          <label class="custom-control-label" for="customCheck1">Check 1</label>
        </div>
      </div>
     <div class="cd-input-wrapper cd-select">
        <select name="select-this" id="select-this" class="custom-select input-sm form-control form-control-sm">
          <option value="0">Select</option>
          <option value="1">Option 1</option>
          <option value="2">Option 2</option>
          <option value="2">Option 3</option>
        </select>
      </div>
    </fieldset>
  </form>
</section>
</div>

<div class="row">
<section id="langswitch-card" class="col m-1">
    <h2>Component: langswitch</h2>

    <div class="cd-box">
        @include('components.langswitch')
    </div>

    <div class="cd-box code lang-php hljs xml">
        @@include('components.langswitch')
    </div>
</section>

<section id="tags-card" class="col m-1">
    @php
      $tags = Spatie\Tags\Tag::factory(5)->make();
    @endphp
    <h2>Component: tags</h2>

    <div class="cd-box">
        @include('components.tags')
    </div>

    <div class="cd-box code lang-php hljs xml">
        @@include('components.tags', ['tags' => $tags])
    </div>
</section>

</div>

</div>

</main>

@endsection

@push('styles')
  <link rel="stylesheet" href="{{ mix('/css/styleguide.css') }}">
@endpush

@push('scripts')
  <script type="text/javascript" src="/js/styleguide.js"></script>
@endpush
