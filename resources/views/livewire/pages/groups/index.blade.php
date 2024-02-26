<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
  <h1 class="text-3xl font-bold">Your Groups</h1>

  <div class="mt-5 flex">
    <button class="flex w-20 flex-col items-center" onclick="createModal.showModal()">
      <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary">
        <x-icon class="h-7 w-7 text-white" name="o-plus" />
      </div>
      <p class="mt-2 text-sm font-semibold uppercase text-primary">Add New</p>
    </button>


    <x-group-avatar />
    <x-group-avatar />
    <x-group-avatar />

  </div>

  <div class="mt-10 grid gap-4 lg:grid-cols-3">
    <x-card-prediction />
    <x-card-prediction />
    <x-card-prediction />
  </div>

  {{-- Disband group modal --}}
  <x-modal id="createModal" title="Create new group">
    <form method="post">
      <x-custom-input label="Name" wire:model="name" autofocus required />
    </form>

    <x-slot:actions>
      <x-button label="Cancel" onclick="createModal.close()" />
      <x-button class="btn-primary" label="Submit" />
    </x-slot:actions>
  </x-modal>
</div>
