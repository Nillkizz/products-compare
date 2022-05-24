@props(['title' => 'Admin Canvas'])
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

<body>
  <!-- Page Container -->
  <div id="page-container">
    <!-- Main Container -->
    <main id="main-container">
      {{ $slot }}
    </main>
    <!-- END Main Container -->
  </div>
  <!-- END Page Container -->

  <!-- Dashmix Core JS -->
  <script src="{{ mix('static/core/js/dashmix.core.js') }}"></script>

  <!-- Laravel Original JS -->
  <script src="{{ mix('static/admin/js/app.js') }}"></script>

  {{ $js_after ?? '' }}
</body>

</html>
