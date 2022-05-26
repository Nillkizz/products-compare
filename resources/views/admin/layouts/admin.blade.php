@props(['css_before', 'css_after', 'js_after'])


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

<body {{ $attributes->class(['admin', 'sidebar']) }}>
  <!-- Page Container -->
  <div id="page-container"
    class="sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow">


    {{-- <x-admin.sidebar /> --}}
    <x-admin.sidebar />
    <x-admin.header />

    <!-- Main Container -->
    <main id="main-container">
      {{ $slot }}
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
      <div class="content py-0">
        <div class="row fs-sm">
          <div class="col-sm-6 order-sm-2 mb-sm-0 text-sm-end mb-1 text-center">
            Crafted with <i class="fa fa-heart text-danger"></i> by <a class="fw-semibold"
              href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
          </div>
          <div class="col-sm-6 order-sm-1 text-sm-start text-center">
            <a class="fw-semibold" href="{{ route('home') }}" target="_blank">PCMpare</a>
            &copy;
            <span data-toggle="year-copy"></span>
          </div>
        </div>
      </div>
    </footer>
    <!-- END Footer -->
  </div>
  <!-- END Page Container -->

  <!-- Dashmix Core JS -->
  <script src="{{ mix('static/core/js/core.js') }}"></script>

  <!-- Laravel Original JS -->
  <script src="{{ mix('static/admin/js/app.js') }}"></script>

  {{ $js_after ?? '' }}
</body>

</html>
