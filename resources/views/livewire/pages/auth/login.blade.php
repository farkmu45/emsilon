<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;

new #[Layout('layouts.guest')] class extends Component {
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ]);

        $this->authenticate();

        Session::regenerate();

        $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
    }

    public function googleLogin(): void {

    }

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt($this->only(['email', 'password']), $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => 'Your email and password is wrong, try again',
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>

<div>
  <form class="flex flex-col" wire:submit="login">
    <div>
      <x-mary-input class="input-base" label="Email" wire:model="email" required />
    </div>

    <div class="mt-4">
      <x-mary-input class="input-base" label="Password" wire:model="password" required
        autocomplete="current-password" />
    </div>

    <div class="mt-4 flex justify-between">
      <x-mary-toggle label="Remember me" wire:model="remember" />

      <a class="link ml-auto no-underline" href="{{ route('password.request') }}" wire:navigate>
        Forgot password?
      </a>
    </div>


    <x-mary-button class="btn-primary mt-10" type="submit" spinner="login">Login</x-mary-button>
    <x-mary-button class="mt-5" spinner="googleLogin" type="submit">Login with Google</x-mary-button>

    <a class="link ml-auto mt-8 no-underline" href="{{ route('register') }}" wire:navigate>
      Create new account
    </a>
  </form>
</div>
