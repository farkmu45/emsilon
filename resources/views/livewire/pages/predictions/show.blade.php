<?php

use Livewire\Volt\Component;
use App\Models\Prediction;
use Illuminate\Support\Facades\Gate;

new class extends Component {
    public Prediction $prediction;

    public function mount()
    {
        Gate::authorize('view', $this->prediction);
    }
}; ?>

<div>
  <div class="flex items-center">
    <h1 class="text-3xl font-bold text-gray-700">Prediction details</h1>
    <a class="btn ml-auto bg-white" href="{{ route('predictions.create', ['predictionId' => $prediction->id]) }}">Use as
      base</a>
  </div>
  <div class="mt-8 h-[30rem] rounded-md bg-white px-5 py-4 shadow-sm">
    <div>
      <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Suitability rate</p>
      <p class="{{ $prediction->result ? 'text-success' : 'text-error' }} mt-1 text-4xl font-bold">
        {{ $prediction->success_rate }}%</p>
    </div>

    <div class="mt-3 grid gap-y-4 md:grid-cols-2 lg:grid-cols-3">
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Species</p>
        <p class="mt-1 text-sm text-gray-700">{{ $prediction->species->name }}</p>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">EMS concentration</p>
        <p class="mt-1 text-sm text-gray-700">{{ $prediction->ems_concentration }}%</p>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">First soak duration</p>
        <p class="mt-1 text-sm text-gray-700">@formatNum($prediction->first_soak_duration) minutes</p>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Second soak duration</p>
        <p class="mt-1 text-sm text-gray-700">@formatNum($prediction->second_soak_duration) minutes</p>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Lowest temperature</p>
        <p class="mt-1 text-sm text-gray-700">{{ $prediction->lowest_temperature }} °C</p>
      </div>
      <div>
        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Highest temperature</p>
        <p class="mt-1 text-sm text-gray-700">{{ $prediction->highest_temperature }} °C</p>
      </div>
    </div>
  </div>
</div>
