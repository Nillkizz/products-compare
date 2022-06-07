@props(['label', 'name', 'type' => 'text', 'idPrefix' => '', 'class' => ''])
@php
$id = $idPrefix . $name;
@endphp

<div @class('mb-4 ' . $class)>
  @isset($label)
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
  @endisset
  <input type="{{ $type }}" class="form-control" id="{{ $id }}" name="{{ $name }}"
    value="{{ old($name) }}" {{ $attributes->merge() }}>
</div>
