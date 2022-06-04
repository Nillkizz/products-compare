@props(['bodyClass' => '', 'pageClass' => ''])
<x-admin.layouts.canvas :pageClass="'sidebar-o enable-page-overlay sidebar-dark side-scroll page-header-fixed main-content-narrow ' . $pageClass" :bodyClass="'sidebar ' . $bodyClass">
  <x-slot name="css_before">
    {{ $css_before ?? '' }}
  </x-slot>
  <x-slot name="css_after">
    {{ $css_after ?? '' }}
  </x-slot>

  {{-- <x-admin.sidebar /> --}}
  <x-admin.sidebar />
  <x-admin.header />

  <!-- Main Container -->
  <main id="main-container">
    {{ $bodyClass }}
    {{ $slot }}
  </main>
  <!-- END Main Container -->

  <!-- Footer -->
  <footer id="page-footer" class="bg-body-light">
    <div class="content py-0">
      <div class="row fs-sm">
        <div class="col-sm-6 order-sm-1 text-sm-start text-center">
          <a class="fw-semibold" href="{{ route('home') }}" target="_blank">PCMpare</a>
          &copy;
          <span data-toggle="year-copy"></span>
        </div>
      </div>
    </div>
  </footer>
  <!-- END Footer -->

  <x-slot name="js_before">
    {{ $js_before ?? '' }}
  </x-slot>
  <x-slot name="js_after">
    {{ $js_after ?? '' }}
  </x-slot>
</x-admin.layouts.canvas>
