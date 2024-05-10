<?php

use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {
    public $predictions;

    public function mount()
    {
        $this->predictions = Prediction::where('user_id', auth()->user()->id)
            ->whereHas('group', fn($query) => $query->where('name', 'Personal'))
            ->get();
    }
}; ?>

<div>
  <h1 class="text-3xl font-bold">Prediction history</h1>

  <div class="mt-5 grid gap-4 lg:grid-cols-3">
    @foreach ($predictions as $prediction)
      <x-card-prediction result="{{ $prediction->result }}" species="{{ $prediction->species->name }}"
        successRate="{{ $prediction->success_rate }}" success="{{ $prediction->result }}"
        createdAt="{{ $prediction->created_at }}" link="{{ route('predictions.show', $prediction->id) }}" />
    @endforeach
  </div>
</div>
