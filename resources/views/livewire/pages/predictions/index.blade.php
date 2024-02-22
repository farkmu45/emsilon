<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
  <h1 class="text-3xl font-bold">Prediction history</h1>

  <div class="grid gap-4 lg:grid-cols-3 mt-5">
    <x-card-prediction />
    <x-card-prediction />
    <x-card-prediction />
  </div>
</div>
