@props(['rate' => 0, 'count' => 0])

<div {{ $attributes->class(['d-flex']) }}>
  @for ($i = 0; $i < 5; $i++)
    <i data-alt="{{ $i }}"
      class="fa fa-fw fa-star {{ $rate > $i ? 'text-warning' : 'text-muted' }}"></i>&nbsp;
  @endfor
  <div class="fs-7 text-muted" style="bottom: -.3rem">
    {{ $count }}
  </div>
</div>
