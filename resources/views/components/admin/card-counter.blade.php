@props(['icon', 'title', 'value', 'percent', 'link', 'url'])

<x-admin.card {{ $attributes->class('text-center') }}>
  @isset($icon)
    <div class="item rounded-3 bg-body mx-auto my-3">
      <i class="fa fa-lg text-primary {{ $icon }}"></i>
    </div>
  @endisset
  @isset($value)
    <div class="fs-1 fw-bold">{{ $value }}</div>
  @endisset
  @isset($title)
    <div class="text-muted mb-3">{{ $title }}</div>
  @endisset
  @isset($percent)
    @php
      $caret = $percent > 0 ? 'fa-caret-up' : 'fa-caret-down';
      $color = $percent > 0 ? 'success' : ($percent == 0 ? 'gray' : 'danger');
    @endphp
    <div
      class="d-inline-block rounded-pill fs-sm fw-semibold text-{{ $color != 'gray' ? $color : 'gray-dark' }} bg-{{ $color }}-light px-3 py-1">
      @if ($percent != 0)
        <i class="fa {{ $caret }} me-1"></i>
      @endif
      {{ $percent }}%
    </div>
  @endisset
  @isset($link)
    <x-slot name="footer">
      <a class="fw-medium" href="{{ $url }}">
        {{ $link }}
        <i class="fa fa-arrow-right ms-1 opacity-25"></i>
      </a>
    </x-slot>
  @endisset
</x-admin.card>
