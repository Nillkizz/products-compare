<header id="page-header">
  <!-- Header Content -->
  <div class="content-header">
    <!-- Left Section -->
    <x-logo class="fs-3" />
    <!-- END Left Section -->

    <!-- Right Section -->
    <div class="space-x-1">


      <div class="d-flex flex-sm-row-reverse">
        <!-- Open Search Section -->
        <button type="button" class="btn btn-alt-secondary mx-1" data-toggle="layout" data-action="header_search_on">
          <i class="fa fa-fw fa-search opacity-50"></i> <span class="ms-1 d-none d-sm-inline-block">Search</span>
        </button>
        <!-- END Open Search Section -->

        <div class="d-flex align-items-center">
          <!-- Menu -->
          <div class="d-none d-lg-block">
            <x-public.nav />
          </div>
          <!-- END Menu -->
          <!-- Toggle Sidebar -->
          <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
          <button type="button" class="btn btn-alt-secondary d-lg-none" data-toggle="layout"
            data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
          </button>
          <!-- END Toggle Sidebar -->
        </div>

      </div>

    </div>
    <!-- END Right Section -->
  </div>
  <!-- END Header Content -->

  <!-- Header Search -->
  <div id="page-header-search" class="overlay-header bg-header-dark">
    <div class="bg-white-10">
      <div class="content-header">
        <form class="w-100" action="be_pages_generic_search.php" method="POST">
          <div class="input-group">
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-alt-primary" data-toggle="layout" data-action="header_search_off">
              <i class="fa fa-fw fa-times-circle"></i>
            </button>
            <input type="text" class="form-control border-0" placeholder="Search or hit ESC.."
              id="page-header-search-input" name="page-header-search-input">
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END Header Search -->

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
        <span class="smini-visible">
          D<span class="opacity-75">x</span>
        </span>
        <span class="smini-hidden">
          Dash<span class="opacity-75">mix</span>
        </span>
      </a>
      <!-- END Logo -->

      <!-- Options -->
      <div>
        <!-- Toggle Sidebar Style -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <!-- Class Toggle, functionality initialized in Helpers.dmToggleClass() -->
        <button type="button" class="btn btn-sm btn-alt-secondary" data-toggle="class-toggle"
          data-target="#sidebar-style-toggler" data-class="fa-toggle-off fa-toggle-on"
          onclick="Dashmix.layout('sidebar_style_toggle');">
          <i class="fa fa-toggle-off" id="sidebar-style-toggler"></i>
        </button>
        <!-- END Toggle Sidebar Style -->

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
      <div class="simplebar-placeholder" style="width: auto; height: 274px;"></div>
    </div>
    <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
      <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
    </div>
    <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
      <div class="simplebar-scrollbar" style="height: 0px; display: none;"></div>
    </div>
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
