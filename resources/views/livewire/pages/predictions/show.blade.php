<?php

use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {

    public Prediction $prediction;

    public function mount(Prediction $prediction)
    {
        $this->prediction = $prediction;
    }

}; ?>

<div>
  <h1 class="text-3xl font-bold">Prediction details</h1>
  <p>{{$prediction->id}}</p>
</div>
