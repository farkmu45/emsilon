<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\ValidationException;

new #[Layout('components.layouts.guest')] class extends Component {
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

        $this->redirect(session('url.intended', RouteServiceProvider::HOME));
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
  <form class="grid gap-y-5" wire:submit="login">
    <x-custom-input label="Email" wire:model="email" autofocus required />
    <x-custom-input type="password" label="Password" wire:model="password" required />
    <div class="flex justify-between">
      <x-toggle class="text-gray-600" label="Remember me" wire:model="remember" />

      <a class="link ml-auto text-gray-600 no-underline" href="{{ route('password.request') }}">
        Forgot password?
      </a>
    </div>


    <x-button class="btn-primary mt-10" type="submit" spinner="login">Login</x-button>

    <a class="link ml-auto mt-4 text-gray-600 no-underline" href="{{ route('register') }}">
      Create new account
    </a>
  </form>
</div>
