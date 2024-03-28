<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.guest')] class extends Component {
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
  <div class="mb-4 text-sm text-gray-600">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
  </div>

  <form wire:submit="sendPasswordResetLink">
    <x-mary-input class="input-base" type="email" label="Email" wire:model="email" required autofocus />

    <div class="mt-4 flex items-center justify-end">
      <x-mary-button class="btn-primary" type="submit">
        Send Password Reset Link
      </x-mary-button>
    </div>
  </form>
</div>
