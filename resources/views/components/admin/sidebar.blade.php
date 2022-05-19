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
        <li class="nav-main-item">
          <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}" href="/dashboard">
            <i class="nav-main-link-icon fa fa-location-arrow"></i>
            <span class="nav-main-link-name">Dashboard</span>
            {{-- <span class="nav-main-link-badge badge rounded-pill bg-primary">5</span> --}}
          </a>
        </li>
        <li class="nav-main-heading">Products</li>
        <li class="nav-main-item{{ request()->is('admin/products/*') ? ' open' : '' }}">
          <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true"
            href="#">
            <i class="nav-main-link-icon fa fa-lightbulb"></i>
            <span class="nav-main-link-name">Examples</span>
          </a>
          <ul class="nav-main-submenu">
            <li class="nav-main-item">
              <a class="nav-main-link{{ request()->is('pages/datatables') ? ' active' : '' }}"
                href="/pages/datatables">
                <span class="nav-main-link-name">DataTables</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link{{ request()->is('pages/slick') ? ' active' : '' }}" href="/pages/slick">
                <span class="nav-main-link-name">Slick Slider</span>
              </a>
            </li>
            <li class="nav-main-item">
              <a class="nav-main-link{{ request()->is('pages/blank') ? ' active' : '' }}" href="/pages/blank">
                <span class="nav-main-link-name">Blank</span>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-main-heading">More</li>
        <li class="nav-main-item">
          <a class="nav-main-link" href="/">
            <i class="nav-main-link-icon fa fa-globe"></i>
            <span class="nav-main-link-name">Landing</span>
          </a>
        </li>
      </ul>
    </div>
    <!-- END Side Navigation -->
  </div>
  <!-- END Sidebar Scrolling -->
</nav>
<!-- END Sidebar -->
