<?php
use Livewire\Volt\Component;

new class extends Component {
    public $count = 0;
}; ?>

<div>
  <h1>Hi John</h1>
  <h3>Summary of your past analysis</h3>

  <div class="grid grid-cols-2 gap-x-4">
    <x-stat value="44" title="Avg success rate" tooltip="Hello" />
    <x-stat value="44" title="Total prediction" tooltip="Hello" />
  </div>

  <div class="flex justify-between">

    <h2>Recent Analysis</h2>
    <a href="">See all</a>
  </div>

  <x-card>
    <p>Successful treatment</p>

  </x-card>


</div>
