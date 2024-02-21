<?php

use Livewire\Volt\Component;

new class extends Component {
    public ?string $species = null;
    public float $concentration = 0;
    public int $presoakDuration = 0;
    public int $soakDuration = 0;
    public float $lowestTemperature = 0;
    public float $highestTemperature = 0;
    public bool $remember = false;

    public function predict()
    {
        dd(request()->all());
    }
}; ?>

<div>
  <h1 class="text-3xl font-bold">Create prediction</h1>
  <h3 class="mt-2 text-lg font-medium text-neutral-600">Predict the suitability of treatment in another species</h3>

  <div class="mt-5">
    <form method="post" class="flex flex-col" wire:submit="predict">
      <div class="grid gap-y-4 lg:grid-cols-2 lg:gap-4">
        <x-select label="Species" wire:model="species" />
        <x-input type="number" label="EMS concentration" wire:model="concentration" required suffix="%" />
        <x-input type="number" label="Presoak duration" wire:model="presoakDuration" required suffix="Minutes" />
        <x-input type="number" label="Soak duration" wire:model="soakDuration" required suffix="Minutes" />
        <x-input type="number" label="Lowest temperature" wire:model="lowestTemperature" required suffix="Celsius" />
        <x-input type="number" label="Highest temperature" wire:model="highestTemperature" required suffix="Celsius" />
      </div>

      <x-button class="btn-primary mt-5 lg:ml-auto w-full lg:w-auto" type="submit" spinner="predict">Predict</x-button>
    </form>
  </div>


</div>
