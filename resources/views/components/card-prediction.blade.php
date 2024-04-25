@props(['result', 'species', 'successRate', 'createdAt', 'link'])

<a href="{{ $link }}">
  <x-card>
    <div class="flex items-center justify-between">
      <div>
        <p class="{{ $result ? 'text-success' : 'text-error' }} mb-4 font-medium">
          {{ $result ? 'Suitable treatment' : 'Unsuitable treatment' }}
        </p>
        <div class="flex flex-row items-center gap-x-2 text-gray-500">
          <x-heroicon-o-sun class="h-5" />
          <p class="text-sm">{{ \Illuminate\Support\Str::limit($species, 20) }}</p>
        </div>
        <div class="mt-1 flex flex-row items-center gap-x-2 text-gray-500">
          <x-heroicon-o-clock class="h-5" />
          <p class="text-sm">{{ \Carbon\Carbon::parse($createdAt)->diffForHumans() }}</p>
        </div>
      </div>
      <div class="text-center">
        <p class="text-3xl font-extrabold text-error">{{ $successRate }}%</p>
        <p class="text-sm text-gray-500">Success rate</p>
      </div>
    </div>
  </x-card>
</a>
