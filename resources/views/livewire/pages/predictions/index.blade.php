<?php

use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {
    public $perPage = 10;

    public function with(): array
    {
        $personalGroup = auth()->user()->personalGroup();
        return [
            'predictions' => Prediction::where('user_id', auth()->user()->id)
                ->whereHas('group', fn($query) => $query->where('name', 'Personal'))
                ->latest()
                ->take($this->perPage)
                ->get(),
        ];
    }

    public function loadMore()
    {
        $this->perPage += 10;
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

  @if (!count($predictions))
    <x-data-empty class="mt-24" label="No predictions available" />
  @endif

  <div class="flex w-full items-center justify-center p-12" x-intersect.full="$wire.loadMore()">
    <x-loading class="loading-lg text-primary" wire:loading wire:target="loadMore" />
  </div>
</div>
