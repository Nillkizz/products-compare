@props(['class1' => 'text-dark', 'class2' => 'text-primary'])
<div {{ $attributes->class(['brand']) }}>
  <span @class($class1)>PCM</span><span @class($class2)>pare</span>
</div>
