<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
  <h1 class="text-3xl font-bold">Your Groups</h1>

  <div class="flex mt-5">
    <a class="flex flex-col items-center w-20" href="#">
      <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary" href="#">
        <x-icon class="h-7 w-7 text-white" name="o-plus" />
      </div>
      <p class="mt-2 text-sm font-semibold uppercase text-primary">Add New</p>
    </a>


    <x-group-avatar />
    <x-group-avatar />
    <x-group-avatar />

  </div>
</div>
