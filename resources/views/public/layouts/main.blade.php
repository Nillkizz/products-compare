@props(['css_before', 'css_after', 'js_after', 'body_class' => '', 'main_class' => ''])

<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  @meta

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts and Styles -->
  {{ $css_before ?? '' }}
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  <link rel="stylesheet" id="css-core" href="{{ mix('static/core/css/app.css') }}">
  <link rel="stylesheet" id="css-main" href="{{ mix('static/public/css/app.css') }}">
  {{ $css_after ?? '' }}

  <!-- Scriptsphp -->
  <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
</head>

<body @class('public ' . $body_class)>
  <!-- Page Container -->
  <div id="page-container" class="main-content-boxed bg-white">


    {{-- <x-admin.sidebar />
    <x-admin.header /> --}}
    <x-public.header />

    <!-- Main Container -->
    <main id="main-container" @class($main_class)>
      {{ $slot }}
    </main>
    <!-- END Main Container -->
    <x-public.footer />
  </div>
  <!-- END Page Container -->

  <!-- Dashmix Core JS -->
  <script src="{{ mix('static/core/js/core.js') }}"></script>

  <!-- Laravel Original JS -->
  <script src="{{ mix('static/public/js/app.js') }}"></script>

  {{ $js_after ?? '' }}


  <script src="{{ mix('static/core/js/alpine.js') }}"></script>
</body>

</html>
