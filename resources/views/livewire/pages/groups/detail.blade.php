<?php

use Livewire\Volt\Component;
use App\Models\Group;
use App\Models\User;

new class extends Component {
    public Group $group;
    public int $leaderId;

    public function mount() {
        $this->leaderId = $this->group->members->where('is_creator', true)->first()->user_id;
    }
}; ?>

<div>
  <div class="text-center">
    <h1 class="text-xl font-semibold">{{ $group->name }}</h1>
    <div class="mt-10 flex justify-center">
      <h3 class="text-2xl font-semibold">{{ $group->code }}</h3>
      <x-heroicon-o-clipboard-document class="ml-1 h-4 text-primary" />
    </div>
    <p class="mt-5">This is the code for this group, others can use this code to join this group</p>
  </div>

  <h3 class="mt-16 text-xl font-bold">Group members</h3>
  <div class="mt-4 flex flex-col gap-y-3">
    @foreach ($this->group->members()->orderBy('is_creator', 'desc')->get() as $member)
      <x-member-item isCreator="{{ $member->user->id == $leaderId }}" :name="$member->user->name" />
    @endforeach
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
