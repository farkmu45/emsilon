@props(['label' => 'Data unavailable'])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center']) }}>
  <x-heroicon-m-x-circle class="h-32 w-32 fill-gray-300" />
  <p class="mt-2 text-xl text-gray-400">{{ $label }}</p>
</div>
