<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
  <div class="text-center">
    <h1 class="text-xl font-semibold">Group 1</h1>
    <div class="mt-10 flex justify-center">
      <h3 class="text-2xl font-semibold">341 256 783</h3>
      <x-heroicon-o-clipboard-document class="ml-1 h-4 text-primary" />
    </div>
    <p class="mt-5">This is the code for this group, others can use this code to join this group</p>
  </div>

  <h3 class="mt-16 text-xl font-bold">Group members</h3>
  <div class="mt-4">
    <x-member-item />
    <x-member-item />
    <x-member-item />
  </div>

  <div class="mt-10 flex flex-col">
    <a class="btn btn-primary" href="">Invite friends</a>
    <button class="btn btn-error mt-3 text-white" onclick="disbandModal.showModal()">Disband group</button>
  </div>


  {{-- Disband group modal --}}
  <x-modal id="disbandModal" title="Are you sure?">
    All predictions created will be deleted permanently.

    <x-slot:actions>
      {{-- Notice `onclick` is HTML --}}
      <x-button label="Cancel" onclick="disbandModal.close()" />
      <x-button class="btn-primary" label="Confirm" />
    </x-slot:actions>
  </x-modal>
</div>
