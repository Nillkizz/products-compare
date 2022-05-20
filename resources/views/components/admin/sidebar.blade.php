@php
/*  Recursive nav generator  */

// NavItem may be just a string, submenu or link. As $route => $navItem, or $strin if it is heading.

// Example of fullitem:
/*
    [
        'title' => 'Login',
        'type' => 'submenu',
        'icon' => 'fa fa-key',
        'submenu' => [
            'admin.dashboard' => [
                'title' => 'Dashboard',
                'icon' => 'fa fa-location-arrow',
            ],
        ],
    ],
*/
$sidebarNav = [
    'admin.dashboard' => [
        'title' => 'Dashboard',
        'icon' => 'fa fa-location-arrow',
    ],
];

if (!class_exists('NavBarWalker')) {
    class NavBarWalker
    {
        function __construct()
        {
            $this->hasActive = false;
            $this->level = 0;
        }
        function prepare($navItems)
        {
            $this->level++;
            $hasActive = false;
            foreach ($navItems as $route => &$navItem) {
                switch ($this->getNavItemType($navItem)) {
                    case 'link':
                        $navItem['type'] = 'link';
                        if (!$hasActive && !$this->hasActive && request()->routeIs($route)) {
                            $this->hasActive = $hasActive = $navItem['active'] = true;
                        } else {
                            $navItem['active'] = false;
                        }
                        break;
                    case 'submenu':
                        $navItem['type'] = 'submenu';
                        $preparedNavItems = $this->prepare($navItem['submenu']);
                        $navItem['submenu'] = $preparedNavItems['navItems'];
                        $hasActive = $navItem['open'] = $preparedNavItems['hasActive'];
                        break;
                    case 'heading':
                        $navItem = ['type' => 'heading', 'title' => $navItem];
                    default:
                        $navItem['norender'] = true;
                        break;
                }
            }
            $this->level--;
            if ($this->level > 0) {
                return compact('hasActive', 'navItems');
            } else {
                return $navItems;
            }
        }
        function getNavItemType($navItem)
        {
            return is_string($navItem) ? 'heading' : Arr::get($navItem, 'type', 'link');
        }
    }
}

$walker = new NavBarWalker($sidebarNav);
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
