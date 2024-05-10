<?php

use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {
    public $perPage = 10;
    public $predictions;

    public function mount()
    {
        $personalGroup = auth()->user()->personalGroup();
        $this->predictions = Prediction::whereHas('group', fn($query) => $query->where('name', 'Personal')->whereNot('id', $personalGroup->id))
            ->where('result', 1)
            ->latest()
            ->paginate($this->perPage)
            ->items();
    }
}; ?>

<div>
  <h1 class="text-3xl font-bold">Browse</h1>
  <h3 class="mt-2 text-lg font-medium text-neutral-600">Find any mutagenesis treatment to use as prediction base</h3>

  <div class="mt-10 grid gap-y-4 lg:grid-cols-3 lg:gap-x-3">
    @foreach ($predictions as $prediction)
      <x-card-browse result="{{ $prediction->result }}" species="{{ $prediction->species->name }}"
        suitabilityRate="{{ $prediction->success_rate }}" success="{{ $prediction->result }}"
        createdAt="{{ $prediction->created_at }}" creator="{{ $prediction->user->name }}"
        link="{{ route('predictions.create', ['predictionId' => $prediction->id]) }}" />
    @endforeach
  </div>
</div>
