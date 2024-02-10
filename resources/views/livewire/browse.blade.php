<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<div>
  <h1 class="text-3xl font-bold">Browse</h1>
  <h3 class="mt-2 text-lg font-medium text-neutral-600">Find any mutagenesis treatment to use as prediction base</h3>

  <div class="grid lg:grid-cols-3 lg:gap-x-3 gap-y-4 mt-10">
    <x-card-browse />
    <x-card-browse />
    <x-card-browse />
    <x-card-browse />
  </div>
</div>
