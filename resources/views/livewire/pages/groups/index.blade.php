<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\GroupCreateForm;
use App\Livewire\Forms\JoinGroupForm;
use App\Models\Group;
use Mary\Traits\Toast;

new class extends Component {
    use Toast;

    public ?Group $selectedGroup;
    public $groups;
    public GroupCreateForm $createForm;
    public JoinGroupForm $joinGroupForm;
    public bool $createModal = false;
    public bool $joinGroupModal = false;

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

    public function join()
    {
        $result = $this->joinGroupForm->join();
        if (!$this->getErrorBag()->any()) {
            $this->joinGroupModal = false;

            if ($result) {
                $this->groups = auth()->user()->groups();
                $this->toast(type: 'success', title: 'Successfully joined the group', position: 'toast-top toast-end', icon: 'o-information-circle');
            } else {
                $this->toast(type: 'error', title: 'An error occured while joining the group', position: 'toast-top toast-end', icon: 'o-information-circle');
            }
        }
    }
}; ?>

<div>
  <div class="flex items-center">
    <h1 class="text-3xl font-bold">Your Groups</h1>
    <button class="btn btn-primary fixed bottom-28 right-7 ml-auto lg:static lg:ml-auto"
      @click="$wire.joinGroupModal = true">
      Join Group
    </button>
  </div>

  <div class="mt-5 flex items-center">
    <button class="flex w-20 flex-col items-center" @click="$wire.createModal = true">
      <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary">
        <x-icon class="h-7 w-7 text-white" name="o-plus" />
      </div>
      <p class="mt-2 text-sm font-semibold uppercase text-primary">Add New</p>
    </button>


    @foreach ($groups as $group)
      <x-group-avatar name="{{ $group->name }}" wire:click="changeActiveGroup({{ $group }})"
        active="{{ $group->id == $selectedGroup->id }}"
        creator="{{ $group->members->where('is_creator', true)->first()->user->name }}"
        wire:key="{{ $group->id }}" />
    @endforeach

    <a class="link mb-6 ml-auto font-medium text-primary no-underline"
      href="{{ $this->selectedGroup ? route('groups.detail', $this->selectedGroup->id) : '/groups/#' }}">Edit group</a>
  </div>

  <div class="mt-10 grid gap-4 lg:grid-cols-3">
    @forelse ($this->selectedGroup->predictions ?? [] as $prediction)
      <x-card-prediction :link="route('predictions.show', $prediction->id)" :result="$prediction->result" :species="$prediction->species->name" :createdAt="$prediction->created_at" :successRate="$prediction->success_rate" />
    @empty
      Empty
    @endforelse
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


  {{-- Create group modal --}}
  <x-modal class="backdrop-blur" title="Join group via code" wire:model="joinGroupModal">
    <form method="post" wire:submit="create">
      <x-custom-input label="Enter code" wire:model="joinGroupForm.code" autofocus required />
    </form>

    <x-slot:actions>
      <x-button @click="$wire.joinGroupModal = false" label="Cancel" onclick="joinGroupModal.close()" />
      <x-button class="btn-primary" wire:click="join" label="Join group" />
    </x-slot:actions>
  </x-modal>
</div>
