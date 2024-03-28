<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME);
    }
}; ?>

<div>
  <form class="grid gap-y-5" wire:submit="register">
    <x-custom-input label="Name" wire:model="name" required autocomplete="name" autofocus />

    <x-custom--input type="email" label="Email" wire:model="email" required autocomplete="email" />

    <x-custom--input type="password" label="Password" wire:model="password" required />

    <x-custom--input type="password" label="Confirm password" wire:model="password_confirmation"
      required />

    <x-button class="btn-primary mt-5" type="submit" spinner="register">Register</x-button>

    <a class="link ml-auto mt-5 no-underline" href="{{ route('login') }}">Already registered?</a>
  </form>
</div>
