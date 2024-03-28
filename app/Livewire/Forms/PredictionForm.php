<?php

namespace App\Livewire\Forms;

use App\Models\Species;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PredictionForm extends Form
{
    #[Validate('required|numeric')]
    public float $ems_concentration = 0;

    #[Validate('required|numeric')]
    public int $first_soak_duration = 0;

    #[Validate('required|numeric')]
    public int $second_soak_duration = 0;

    #[Validate('required|numeric')]
    public float $lowest_temperature = 0;

    #[Validate('required|numeric')]
    public float $highest_temperature = 0;

    #[Validate('required|numeric|exists:species,id')]
    public int $species_id = 1;


    #[Validate('required|numeric|exists:groups,id')]
    public int $group_id = 1;


    public function predict()
    {
        $this->validate();
        $reqData = $this->all();
        $reqData['species'] = Species::find($reqData['species_id'])->name;
        unset($reqData['species_id']);
        unset($reqData['group_id']);

        $response = Http::post('https://farkmu45-emsilon-api.hf.space', $reqData)->body();
        $result = json_decode($response, true);

        $data = $this->all();
        $data['result'] = $result['result'];
        $data['success_rate'] = $result['success_rate'];
        dd($data);

        dd($this->all());
    }
}
