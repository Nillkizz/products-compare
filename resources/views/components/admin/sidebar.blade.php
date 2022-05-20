@php
$sidebarNav = [
    'admin.dashboard' => [
        'title' => 'Dashboard',
        'icon' => 'fa fa-location-arrow',
    ],
];

$walker = new \Helpers\NavBarWalker($sidebarNav);
$sidebarNav = $walker->prepare($sidebarNav);

@endphp

<nav id="sidebar" aria-label="Main Navigation">
  <!-- Side Header -->
  <div class="bg-header-dark">
    <div class="content-header bg-white-5">
      <!-- Logo -->
      <a class="fw-semibold tracking-wide text-white" href="/">
        PCM<span class="opacity-75">pare</span>
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
  <div class="js-sidebar-scroll">
    <!-- Side Navigation -->
    <div class="content-side content-side-full">
      <ul class="nav-main">

        @foreach ($sidebarNav as $route => $navItem)
          <x-admin.sidebar.nav-item :navItem="$navItem" :route="$route" />
        @endforeach

      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
