<?php

use Livewire\Volt\Component;
use App\Models\Group;
use App\Models\User;
use Mary\Traits\Toast;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    use Toast;

    public Group $group;
    public int $leaderId;
    public bool $leaveModal = false;

    public function mount()
    {
        Gate::authorize('view', $this->group);
        $this->leaderId = $this->group->members->where('is_creator', true)->first()->user_id;
    }

    public function leave()
    {
        try {
            $member = $this->group->members->where('user_id', auth()->user()->id)->first();
            $member->delete();
            $this->createModal = false;
            redirect(route('groups.index'));
            $this->toast(type: 'success', title: 'You successfully left the group', position: 'toast-top toast-end', icon: 'o-check-circle', redirectTo: route('groups.index'));
        } catch (\Throwable $th) {
            $this->toast(type: 'error', title: 'An error occured while leaving the group', position: 'toast-top toast-end', icon: 'o-exclamation-mark');
        }
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
    @if ($leaderId == auth()->user()->id)
      <button class="btn btn-error mt-3 text-white" onclick="disbandModal.showModal()">Disband group</button>
    @else
      <button class="btn btn-error mt-3 text-white" @click="$wire.leaveModal = true">Leave group</button>
    @endif
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

  {{-- Leave group modal --}}
  <x-modal class="backdrop-blur" title="Are you sure?" wire:model="leaveModal">
    You will not be able to create any predictions for this group again.

    <x-slot:actions>
      <x-button @click="$wire.leaveModal = false" label="Cancel" onclick="leaveModal.close()" />
      <x-button class="btn-primary" wire:click="leave" label="Yes" />
    </x-slot:actions>
  </x-modal>
</div>
