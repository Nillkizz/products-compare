@props(['type'])

@if (strlen($slot) > 0)
  <div {{ $attributes->merge(['class' => 'alert alert-' . $type]) }} role="alert">
    {{ $slot }}
  </div>
@endif
