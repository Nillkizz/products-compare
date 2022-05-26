<header id="page-header">
  <!-- Header Content -->
  <div class="content-header">
    <!-- Left Section -->
    <a href="{{ route('home') }}">
      <x-logo class="fs-3" />
    </a>
    <form class="col-sm-8 me-auto ms-3" action="{{ route('search') }}" method="get">
      <div class="input-group rounded border">
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <input type="text" class="form-control border-0" placeholder="Search or hit ESC.." id="page-header-search-input"
          name="s" value="{{ request('s') }}">
        @unless(null == request('price_limit'))
          <input type="text" name="price_limit" value="{{ request('price_limit') }}" hidden>
        @endunless
        <button type="submit" class="btn btn-alt-primary">
          <i class="fa fa-fw fa-search"></i>
        </button>
      </div>
    </form>
    <!-- END Left Section -->

    <!-- Right Section -->
    <div class="space-x-1">


      <div class="d-flex flex-sm-row-reverse">

        <div class="d-flex align-items-center">
          <!-- Menu -->
          <div class="d-none d-lg-block">
            <x-public.nav class="nav-main-horizontal nav-main-hover" />
          </div>
          <!-- END Menu -->
          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          {{-- <button type="button" class="btn btn-alt-secondary d-lg-none" data-toggle="layout"
            data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button> --}}
          <!-- END Toggle Sidebar -->
        </div>

      </div>

    </div>
    <!-- END Right Section -->
  </div>
  <!-- END Header Content -->

  <!-- Header Loader -->
  <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
  <div id="page-header-loader" class="overlay-header bg-header-dark">
    <div class="bg-white-10">
      <div class="content-header">
        <div class="w-100 text-center">
          <i class="fa fa-fw fa-sun fa-spin text-white"></i>
        </div>
      </div>
    </div>
  </div>
  <!-- END Header Loader -->
</header>


<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="bg-header-dark">
    <div class="content-header bg-white-5">
      <!-- Logo -->
      <a class="fw-semibold tracking-wide text-white" href="index.php">
        <x-logo type="light" />
      </a>
      <!-- END Logo -->

      <!-- Options -->
      <div>
        <!-- Close Sidebar, Visible only on mobile screens -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <button type="button" class="btn btn-sm btn-alt-secondary d-lg-none" data-toggle="layout"
          data-action="sidebar_close">
          <i class="fa fa-times-circle"></i>
        </button>
        <!-- END Close Sidebar -->
      </div>
      <!-- END Options -->
    </div>
  </div>
  <!-- END Side Header -->

  <!-- Sidebar Scrolling -->
  <div class="js-sidebar-scroll" data-simplebar="init">
    <div class="simplebar-wrapper" style="margin: 0px;">
      <div class="simplebar-height-auto-observer-wrapper">
        <div class="simplebar-height-auto-observer"></div>
      </div>
      <div class="simplebar-mask">
        <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
          <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content"
            style="height: 100%; overflow: hidden;">
            <div class="simplebar-content" style="padding: 0px;">
              <!-- Side Navigation -->
              <div class="content-side">
                <x-public.nav />
              </div>
              <!-- END Side Navigation -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
