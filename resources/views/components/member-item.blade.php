@props(['name'])

<div class="flex cursor-pointer items-center">
  <div class="relative flex ring-2 ring-primary h-10 w-10 items-center justify-center rounded-full">
    <img class="h-8 w-8 rounded-full bg-red-700" src="https://ui-avatars.com/api/?name={{ $name }}" />
  </div>
  <p class="ml-2 ">{{ $name }}</p>
</div>
