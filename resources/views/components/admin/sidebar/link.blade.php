@props(['title', 'route', 'iconClass', 'badge', 'isActive' => false])

<li class="nav-main-item">
  <a class="nav-main-link{{ $isActive ? ' active' : '' }}" href="{{ route($route) }}">
    @isset($iconClass)
      <i @class(['nav-main-link-icon', $iconClass])></i>
    @endisset
    <span class="nav-main-link-name">{{ $title }}</span>
    @isset($badge)
      <span class="nav-main-link-badge badge rounded-pill bg-primary">{{ $badge }}</span>
    @endisset
  </a>
</li>
