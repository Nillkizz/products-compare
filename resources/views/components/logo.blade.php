@props(['type' => 'dark', 'class1' => 'text-dark', 'class2' => 'text-primary'])

@php
switch ($type) {
    case 'light':
        $class1 = 'text-white';
        $class2 = 'text-white opacity-75';
}
@endphp

<div {{ $attributes->class(['brand']) }}>
  <span @class($class1)>PCM</span><span @class($class2)>pare</span>
</div>
