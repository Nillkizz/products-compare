@props(['bodyClass' => '', 'pageClass' => ''])
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
  <link rel="stylesheet" id="css-main" href="{{ mix('static/admin/css/app.css') }}">
  <link rel="stylesheet" id="css-core" href="{{ mix('static/core/css/app.css') }}">
  {{ $css_after ?? '' }}

  <!-- Scripts -->
  <script>
    window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
  </script>
</head>

<body @class('admin ' . $bodyClass)>
  <!-- Page Container -->
  <div id="page-container" @class($pageClass)>
    <!-- Main Container -->
    {{ $slot }}
    <!-- END Main Container -->
  </div>
  <!-- END Page Container -->

  <!-- Dashmix Core JS -->
  {{ $js_before ?? '' }}
  <script src="{{ mix('static/core/js/core.js') }}"></script>
  <x-notification />
  <!-- Laravel Original JS -->
  <script src="{{ mix('static/admin/js/app.js') }}"></script>

  {{ $js_after ?? '' }}
  <script src="{{ mix('static/core/js/alpine.js') }}"></script>
</body>

</html>
