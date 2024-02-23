@props(['active' => false])

<div class="flex w-20 flex-col items-center cursor-pointer">
  <div
    class="{{ $active ? 'border-primary' : 'border-gray-400' }} relative flex h-10 w-10 items-center justify-center rounded-full border-[3px]"
    href="#">
    <img class="h-8 w-8 rounded-full bg-red-700" />
  </div>
  <p class="{{ $active ? 'text-primary' : 'text-gray-400' }} mt-2 text-sm font-semibold uppercase">Group 1
  </p>
</div>
