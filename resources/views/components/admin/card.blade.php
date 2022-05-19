<div {{ $attributes }}>
  <div class="block-rounded d-flex flex-column h-100 mb-0 block">

    @isset($header)
      <div class="block-header block-header-default">
        <h3 class="block-title">{{ $header }}</h3>
      </div>
    @endisset

    @isset($slot)
      <div class="block-content block-content-full flex-grow-1">
        {{ $slot }}
      </div>
    @endisset

    @isset($footer)
      <div class="block-content block-content-full block-content-sm bg-body-light fs-sm">
        {{ $footer }}
      </div>
    @endisset

  </div>
</div>
