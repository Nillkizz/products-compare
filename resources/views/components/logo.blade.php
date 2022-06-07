@props(['type' => 'dark', 'class1' => 'text-dark', 'class2' => 'text-primary'])

@php
switch ($type) {
    case 'light':
        $class1 = 'text-white';
        $class2 = 'text-white opacity-75';
}
@endphp

<div {{ $attributes->class(['brand', 'smini-hidden']) }}>
  <span @class($class1)>PCM</span><span @class($class2)>pare</span>
</div>
<span {{ $attributes->class(['brand', 'smini-visible']) }}>
  <span @class($class1)>P</span><span @class($class2)>p</span>
</span>
