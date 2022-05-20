@props(['navItem', 'route' => null])

@switch($navItem['type'])
  @case('link')
    <x-admin.sidebar.link :title="$navItem['title'] ?? null" :route="$route" :iconClass="$navItem['icon'] ?? null" :badge="$navItem['badge'] ?? null" :isActive="$navItem['active']" />
  @break

  @case('submenu')
    <li class="nav-main-item {{ $navItem['open'] ? 'open' : '' }}">
      <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="true"
        href="#">
        @isset($navItem['icon'])
          <i @class(['nav-main-link-icon', $navItem['icon']])></i>
        @endisset
        <span class="nav-main-link-name">{{ $navItem['title'] }}</span>
      </a>
      @isset($navItem['submenu'])
        <ul class="nav-main-submenu">
          @foreach ($navItem['submenu'] as $route => $navItem)
            <x-admin.sidebar.nav-item :navItem="$navItem" :route="$route" />
          @endforeach
        </ul>
      @endisset
    </li>
  @break

  @case('heading')
    <li class="nav-main-heading">{{ $navItem['title'] }}</li>
  @break

  @default
@endswitch
