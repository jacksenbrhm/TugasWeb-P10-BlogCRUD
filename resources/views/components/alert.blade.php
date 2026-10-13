@props(['type' => 'info'])

@php
    $styles = [
        'success' => 'border-green-300 bg-green-100 text-green-800',
        'danger'  => 'border-red-300 bg-red-100 text-red-800',
        'warning' => 'border-amber-300 bg-amber-100 text-amber-800',
        'info'    => 'border-blue-300 bg-blue-100 text-blue-800',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'mb-4 rounded-lg border px-4 py-3 text-sm font-medium ' . ($styles[$type] ?? $styles['info'])]) }} role="alert">
    {{ $slot }}
</div>
