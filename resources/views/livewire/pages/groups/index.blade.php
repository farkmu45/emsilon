<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\GroupCreateForm;
use App\Models\Group;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public ?Group $selectedGroup;
    public $groups;
    public GroupCreateForm $createForm;
    public bool $createModal = false;

    public function mount()
    {
        $user = auth()->user();
        $this->selectedGroup = $user->groups()[0] ?? null;
        $this->groups = $user->groups();
    }

    public function changeActiveGroup(Group $group)
    {
        $this->selectedGroup = $group;
    }

    public function create()
    {
        $result = $this->createForm->create();
        $user = auth()->user();
        $this->selectedGroup = $user->groups()[0] ?? null;
        $this->groups = $user->groups();
        $this->createModal = false;

        if ($result) {
            $this->toast(type: 'success', title: 'Group created successfully', position: 'toast-top toast-end', icon: 'o-information-circle');
        } else {
            $this->toast(type: 'error', title: 'An error occured while creating group', position: 'toast-top toast-end', icon: 'o-information-circle');
        }
    }
}; ?>

<div>
  <h1 class="text-3xl font-bold">Your Groups</h1>

  <div class="mt-5 flex">
    <button class="flex w-20 flex-col items-center" @click="$wire.createModal = true">
      <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary">
        <x-icon class="h-7 w-7 text-white" name="o-plus" />
      </div>
      <p class="mt-2 text-sm font-semibold uppercase text-primary">Add New</p>
    </button>


    @foreach ($groups as $group)
      <x-group-avatar name="{{ $group->name }}" wire:click="changeActiveGroup({{ $group }})"
        active="{{ $group->id == $selectedGroup->id }}" wire:key="{{ $group->id }}" />
    @endforeach
  </div>

  <div class="mt-10 grid gap-4 lg:grid-cols-3">
    @foreach ($this->selectedGroup->predictions as $prediction)
      <x-card-prediction :link="route('predictions.show', $prediction->id)" :result="$prediction->result" :species="$prediction->species->name" :createdAt="$prediction->created_at" :successRate="$prediction->success_rate" />
    @endforeach
  </div>

  {{-- Create group modal --}}
  <x-modal class="backdrop-blur" title="Create new group" wire:model="createModal">
    <form method="post" wire:submit="create">
      <x-custom-input label="Name" wire:model="createForm.name" autofocus required />
    </form>

    <x-slot:actions>
      <x-button @click="$wire.createModal = false" label="Cancel" onclick="createModal.close()" />
      <x-button class="btn-primary" wire:click="create" label="Submit" />
    </x-slot:actions>
  </x-modal>
</div>
