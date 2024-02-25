<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
  <h1 class="text-3xl font-bold">Your Groups</h1>

  <div class="mt-5 flex">
    <a class="flex w-20 flex-col items-center" href="#">
      <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary" href="#">
        <x-icon class="h-7 w-7 text-white" name="o-plus" />
      </div>
      <p class="mt-2 text-sm font-semibold uppercase text-primary">Add New</p>
    </a>


    <x-group-avatar />
    <x-group-avatar />
    <x-group-avatar />

  </div>

  <div class="grid gap-4 lg:grid-cols-3 mt-10">
    <x-card-prediction />
    <x-card-prediction />
    <x-card-prediction />
  </div>
</div>
