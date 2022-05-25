<ul {{ $attributes->class(['nav-main']) }}>
  @foreach ($items as $route => $navItem)
    <x-nav.item :navItem="$navItem" :route="$route" />
  @endforeach
</ul>
