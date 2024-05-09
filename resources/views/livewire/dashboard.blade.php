<?php
use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {
    public $perPage = 10;
    public $predictions;

    public function mount()
    {
        $personalGroup = auth()->user()->personalGroup();
        $this->predictions = Prediction::where('group_id', $personalGroup->id)
            ->latest()
            ->paginate($this->perPage)
            ->items();
    }
}; ?>

<div>
  <div class="flex items-center">
    <div>
      <h1 class="text-3xl font-bold">Hi {{ head(explode(' ', trim(auth()->user()->name))) }}</h1>
      <h3 class="mt-2 text-neutral-600">Summary of your past analysis</h3>
    </div>
    <a class="btn btn-primary fixed bottom-28 right-7 lg:static lg:ml-auto" href="{{ route('predictions.create') }}"
      icon="o-cube-transparent">
      Predict
    </a>
  </div>

  <div class="mt-4 grid grid-cols-2 gap-x-4">
    <x-stat value="44" title="Avg suitability rate" tooltip="Hello" />
    <x-stat value="44" title="Total prediction" tooltip="Hello" />
  </div>

  <div class="mt-10 flex justify-between">
    <h2 class="text-xl font-semibold">Recent Analysis</h2>
    <a class="flex items-center gap-x-3 text-sm font-medium uppercase tracking-wide text-primary"
      href="{{ route('predictions.index') }}">
      See all
      <x-heroicon-o-arrow-right class="h-5" />
    </a>
  </div>

  <div class="mt-4 grid gap-y-4">
    @foreach ($predictions as $prediction)
      <x-card-prediction result="{{ $prediction->result }}" species="{{ $prediction->species->name }}"
        successRate="{{ $prediction->success_rate }}" createdAt="{{ $prediction->created_at }}"
        link="{{ route('predictions.show', $prediction->id) }}" />
    @endforeach
  </div>

</div>
