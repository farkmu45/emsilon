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
    public bool $disbandModal = false;

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
            $this->leaveModal = false;
            $this->toast(type: 'success', title: 'You successfully left the group', position: 'toast-top toast-end', icon: 'o-check-circle', redirectTo: route('groups.index'));
        } catch (\Throwable $th) {
            $this->toast(type: 'error', title: 'An error occured while leaving the group', position: 'toast-top toast-end', icon: 'o-exclamation-circle');
        }
    }

    public function disband()
    {
        try {
            $this->group->predictions()->where('user_id', auth()->user()->id)->delete();
            $this->group->members()->delete();
            $this->group->delete();
            $this->disbandModal = false;
            $this->toast(type: 'success', title: 'You successfully disbanded the group', position: 'toast-top toast-end', icon: 'o-check-circle', redirectTo: route('groups.index'));
        } catch (\Throwable $th) {
            $this->toast(type: 'error', title: 'An error occured while disbanding the group', position: 'toast-top toast-end', icon: 'o-exclamation-circle');
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
    @if ($leaderId == auth()->user()->id)
      <button class="btn btn-error mt-3 text-white" @click="$wire.disbandModal = true">Disband group</button>
    @else
      <button class="btn btn-error mt-3 text-white" @click="$wire.leaveModal = true">Leave group</button>
    @endif
  </div>


  {{-- Disband group modal --}}
  <x-modal class="backdrop-blur" title="Are you sure?" wire:model="disbandModal">
    All predictions created will be deleted permanently.

    <x-slot:actions>
      <x-button @click="$wire.disbandModal = false" label="Cancel" />
      <x-button class="btn-error text-white" label="Disband" wire:click="disband" />
    </x-slot:actions>
  </x-modal>

  {{-- Leave group modal --}}
  <x-modal class="backdrop-blur" title="Are you sure?" wire:model="leaveModal">
    You will not be able to create any predictions for this group again.

    <x-slot:actions>
      <x-button @click="$wire.leaveModal = false" label="Cancel" />
      <x-button class="btn-error text-white" wire:click="leave" label="Leave" />
    </x-slot:actions>
  </x-modal>
</div>
