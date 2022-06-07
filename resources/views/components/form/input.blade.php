@props(['label', 'name' => '', 'type' => 'text', 'idPrefix' => '', 'class' => '', 'value' => '', 'iclass' => ''])
@php
$id = $idPrefix . $name;
@endphp

<div @class('mb-4 ' . $class)>
  @isset($label)
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
  @endisset
  <div class="d-flex">
    {!! $before_input ?? '' !!}
    <input type="{{ $type }}" @class('form-control ' . $iclass) id="{{ $id }}" name="{{ $name }}"
      value="{{ old($name, $value) }}" {{ $attributes->merge() }}>
    {!! $after_input ?? '' !!}
  </div>
</div>
