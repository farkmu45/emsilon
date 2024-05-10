@props(['result', 'creator', 'species', 'suitabilityRate', 'creator', 'createdAt', 'link'])

<x-card>
  <div class="flex items-center justify-between">
    <div>
      <p class="mb-4 font-medium">{{ \Illuminate\Support\Str::limit($species, 20) }}</p>
      <div class="flex flex-row items-center gap-x-2 text-gray-500">
        <x-heroicon-o-user class="h-5" />
        <p class="text-sm">{{ $creator }}</p>
      </div>
      <div class="mt-1 flex flex-row items-center gap-x-2 text-gray-500">
        <x-heroicon-o-clock class="h-5" />
        <p class="text-sm">{{ \Carbon\Carbon::parse($createdAt)->diffForHumans() }}</p>
      </div>
    </div>
    <div class="flex flex-col items-end text-end">
      <div>
        <x-dropdown>
          <x-slot:trigger>
            <x-heroicon-o-ellipsis-horizontal class="w-6 cursor-pointer text-gray-500" />
          </x-slot:trigger>
          <x-menu-item title="Use as base" link="{{ $link }}" />
        </x-dropdown>
      </div>
      <div>
        <p class="text-3xl font-extrabold">{{ $suitabilityRate }}%</p>
        <p class="text-sm text-gray-500">Suitability rate</p>
      </div>
    </div>
  </div>
</x-card>
