<x-card>
  <div class="flex items-center justify-between">
    <div>
      <p class="mb-4 font-medium">Oryza Sativa</p>
      <div class="flex flex-row items-center gap-x-2 text-gray-500">
        <x-heroicon-o-user class="h-5" />
        <p class="text-sm">Dani</p>
      </div>
      <div class="flex flex-row items-center gap-x-2 text-gray-500">
        <x-heroicon-o-clock class="h-5" />
        <p class="text-sm">2 minutes ago</p>
      </div>
    </div>
    <div class="flex flex-col items-end text-end">
      <div>
        <x-dropdown>
          <x-slot:trigger>
            <x-heroicon-o-ellipsis-horizontal class="w-6 text-gray-500 cursor-pointer" />
          </x-slot:trigger>
          <x-menu-item title="Use as base" />
        </x-dropdown>
      </div>
      <div>
        <p class="text-3xl font-extrabold">95%</p>
        <p class="text-gray-500 text-sm">Suitability rate</p>
      </div>
    </div>
  </div>
</x-card>
