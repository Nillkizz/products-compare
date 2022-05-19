@props(['wrapper', 'input', 'icon' => ''])
@php
$wrapper = array_merge($input, [
    'class' => 'mb-4 ' . ($wrapper['class'] ?? ''),
]);
$input = array_merge($input, [
    'class' => 'form-control ' . ($input['class'] ?? ''),
]);
@endphp

<div {{ $attributes->merge($wrapper) }}>
  <div class="input-group input-group-lg">
    <input {{ $attributes->merge($input) }}>

    @unless(empty($icon))
      <span class="input-group-text">
        <i class="{{ $icon }}"></i>
      </span>
    @endunless
  </div>
</div>
