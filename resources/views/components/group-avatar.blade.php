@props(['active' => false, 'name', 'creator'])

<div class="flex w-20 cursor-pointer flex-col items-center" {{ $attributes }}>
  <div
    class="{{ $active ? 'ring-2 ring-primary' : '' }} relative flex h-10 w-10 items-center justify-center rounded-full">
    <img class="h-8 w-8 rounded-full bg-red-700" src="https://ui-avatars.com/api/?name={{ $creator }}" />
  </div>
  <p class="{{ $active ? 'text-primary' : 'text-gray-400' }} mt-2 text-sm font-semibold uppercase">{{ \Illuminate\Support\Str::limit($name, 7) }}
  </p>
</div>
