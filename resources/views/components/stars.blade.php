@props(['rate' => 0, 'count' => 0, 'hideCount' => false])

<div {{ $attributes->class(['d-flex']) }}>
  @for ($i = 0; $i < 5; $i++)
    <i data-alt="{{ $i }}"
      class="fa fa-fw fa-star {{ $rate > $i ? 'text-warning' : 'text-muted' }}"></i>&nbsp;
  @endfor
  @unless($hideCount)
    <div class="fs-7 text-muted" style="bottom: -.3rem">
      {{ $count }}
    </div>
  @endunless
</div>
