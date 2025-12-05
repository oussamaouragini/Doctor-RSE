@props(['label','color' => 'indigo'])

@php
  $colorClasses = [
    'green' => 'bg-green-100 text-green-800',
    'indigo' => 'bg-indigo-100 text-indigo-800',
    'yellow' => 'bg-yellow-100 text-yellow-800'
  ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2 py-1 text-xs font-medium rounded ' . ($colorClasses[$color] ?? $colorClasses['indigo'])]) }}>
  {{ $label }}
</span>
