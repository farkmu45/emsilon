<?php
use Livewire\Volt\Component;
use App\Models\Prediction;

new class extends Component {
    public $perPage = 10;
    public $predictions;
    public $total = 0;
    public $average = 0;

    public function mount()
    {
        $personalGroup = auth()->user()->personalGroup();
        $predictions = Prediction::where('group_id', $personalGroup->id)
            ->latest()
            ->paginate($this->perPage);
        $this->predictions = $predictions->items();
        $this->total = $predictions->total();
        $this->average = round(Prediction::where('group_id', $personalGroup->id)->avg('success_rate'), 2);
    }
}; ?>

<div>
  <div class="flex items-center">
    <div>
      <h1 class="text-3xl font-bold">Hi {{ head(explode(' ', trim(auth()->user()->name))) }}</h1>
      <h3 class="mt-2 text-neutral-600">Summary of your past predictions</h3>
    </div>
    <a class="btn btn-primary fixed bottom-28 right-7 lg:static lg:ml-auto" href="{{ route('predictions.create') }}"
      icon="o-cube-transparent">
      Predict
    </a>
  </div>

  <div class="mt-4 grid grid-cols-2 gap-x-4">
    <x-stat title="Avg suitability rate" :value="$average . '%'" />
    <x-stat title="Total prediction" :value="$total" />
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
        successRate="{{ $prediction->success_rate }}" success="{{ $prediction->result }}"
        createdAt="{{ $prediction->created_at }}" link="{{ route('predictions.show', $prediction->id) }}" />
    @endforeach
  </div>

  @if (!$predictions)
    <x-data-empty class="mt-20" label="No predictions available" />
  @endif

</div>
