<?php

use Livewire\Volt\Component;
use App\Livewire\Forms\PredictionForm;
use App\Models\Species;
use Illuminate\Database\Eloquent\Collection;

new class extends Component {
    public PredictionForm $form;
    public Collection $groups;
    public Collection $species;

    public function mount()
    {
        $this->species = Species::all();
        $this->groups = auth()->user()->groups();
    }

    public function predict()
    {
        $this->form->predict();
    }
}; ?>

<div>
  <h1 class="text-3xl font-bold">Create prediction</h1>
  <h3 class="mt-2 text-lg font-medium text-neutral-600">Predict the suitability of treatment in another species</h3>

  <div class="mt-5">
    <form class="flex flex-col" wire:submit="predict">
      <div class="grid gap-y-4 lg:grid-cols-2 lg:gap-4">
        <x-custom-select label="Species" :options="$species" wire:model="form.species_id" />
        <x-custom-input type="number" label="EMS concentration" wire:model="form.ems_concentration" required
          suffix="%" />
        <x-custom-input type="number" label="First soak duration" wire:model="form.first_soak_duration" required
          suffix="Minutes" />
        <x-custom-input type="number" label="Second soak duration" wire:model="form.second_soak_duration" required
          suffix="Minutes" />
        <x-custom-input type="number" label="Lowest temperature" wire:model="form.lowest_temperature" required
          suffix="Celsius" />
        <x-custom-input type="number" label="Highest temperature" wire:model="form.highest_temperature" required
          suffix="Celsius" />
        <div class="col-span-full">
          <x-custom-select label="Group" hint="Where do you want to store the prediction?" :options="$groups" wire:model="form.species_id" />
        </div>
      </div>

      <x-button class="btn-primary mt-5 w-full lg:ml-auto lg:w-auto" type="submit" spinner="predict">Predict</x-button>
    </form>
  </div>
</div>
