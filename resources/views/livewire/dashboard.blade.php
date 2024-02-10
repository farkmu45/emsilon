<?php
use Livewire\Volt\Component;

new class extends Component {
    public $count = 0;
}; ?>

<div>
  <h1 class="text-3xl font-bold">Hi John</h1>
  <h3 class="mt-2 text-lg font-medium text-neutral-600">Summary of your past analysis</h3>

  <div class="mt-4 grid grid-cols-2 gap-x-4">
    <x-stat value="44" title="Avg success rate" tooltip="Hello" />
    <x-stat value="44" title="Total prediction" tooltip="Hello" />
  </div>

  <div class="mt-10 flex justify-between">
    <h2 class="text-xl font-semibold">Recent Analysis</h2>
    <a class="flex items-center gap-x-3 uppercase text-primary" href="">
      See all
      <x-heroicon-o-arrow-right class="h-5" />
    </a>
  </div>

  <div class="mt-4 grid gap-y-4">
    <x-card-prediction />
  </div>

  <x-button class="btn-primary fixed bottom-24 right-7 lg:bottom-16 lg:right-16" icon="o-cube-transparent">
    Analyze
  </x-button>
</div>
