<?php
use Livewire\Volt\Component;

new class extends Component {
    public $count = 0;
}; ?>

<div>
  <h1 class="font-bold text-3xl">Hi John</h1>
  <h3 class="font-medium text-lg mt-2 text-neutral-600">Summary of your past analysis</h3>

  <div class="grid grid-cols-2 gap-x-4 mt-4">
    <x-stat value="44" title="Avg success rate" tooltip="Hello" />
    <x-stat value="44" title="Total prediction" tooltip="Hello" />
  </div>

  <div class="flex justify-between mt-10">
    <h2 class="font-semibold text-xl">Recent Analysis</h2>
    <a href="" class="uppercase text-primary flex gap-x-3 items-center">
      See all
      <x-heroicon-o-arrow-right class="h-5"/>
    </a>
  </div>

  <div class="mt-4 grid gap-y-4">
    <x-card-prediction/>
  </div>


</div>
