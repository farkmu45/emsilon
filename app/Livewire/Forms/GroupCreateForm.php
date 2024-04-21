<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use App\Models\Member;
use Livewire\Attributes\Validate;
use Livewire\Form;

class GroupCreateForm extends Form
{
    #[Validate('required|string|max:200')]
    public ?string $name;

    public function create()
    {
        $this->validate();

        $group = Group::create([
            'name' => $this->name,
            'code' => random_int(100000, 999999)
        ]);

        $member = $group->members()->create([
            'user_id' => auth()->user()->id,
            'is_creator' => true
        ]);

        $this->reset();

        if ($group && $member) {
            return true;
        }

        return false;
    }
}
