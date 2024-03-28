<?php
use Livewire\Volt\Component;
use App\Livewire\Actions\Logout;

new class extends Component {
    public string $email = '';
    public string $name = '';
    public string $password = '';
    public string $newPassword = '';
    public string $newPasswordConfirmation = '';

    public function mount()
    {
        $user = auth()->user();
        $this->email = $user->email;
        $this->name = $user->name;
        $this->name = $user->name;
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/login');
    }
}; ?>



<div>
  <h1 class="text-3xl font-bold">Your Profile</h1>
  <div class="mt-10 grid md:grid-cols-2">
    {{-- Avatar --}}
    <div class="flex flex-col items-center">
      <div class="h-40 w-40 rounded-full bg-red-700"></div>
      <p class="mt-5 text-2xl font-semibold">{{ auth()->user()->name }}</p>
    </div>
    {{-- Form --}}
    <div>
      <form class="grid gap-y-4" action="" method="post">
        <x-custom-input label="Name" wire:model="name" autofocus required />
        <x-custom-input label="Email" wire:model="email" required />
        <div class="divider"></div>
        <x-custom-input label="Current password" wire:model="password" />
        <x-custom-input label="New password" wire:model="newPassword" />
        <x-custom-input label="New password confirmation" wire:model="newPasswordConfirmation" />

        <x-button class="btn-primary mt-10" type="submit" spinner="save">Save</x-button>
        <x-button class="btn-error text-white" wire:click="logout" spinner="logout">Logout</x-button>
      </form>
    </div>


  </div>
</div>
