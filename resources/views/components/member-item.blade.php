@props(['name', 'isCreator'])

<div class="flex cursor-pointer items-center">
  <div
    class="{{ $isCreator ? 'ring-2 ring-primary' : '' }} relative flex h-10 w-10 items-center justify-center rounded-full">
    <img class="h-8 w-8 rounded-full bg-red-700" src="https://ui-avatars.com/api/?name={{ $name }}" />
  </div>
  <p class="ml-2">{{ $name }}</p>
</div>
