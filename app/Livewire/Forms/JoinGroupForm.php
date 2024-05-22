<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use Livewire\Attributes\Validate;
use Livewire\Form;

class JoinGroupForm extends Form
{
    #[Validate('required|string|max:6|min:6|exists:groups,code')]
    public ?string $code;

    public function join()
    {
        $this->validate();

        $group = Group::where('code', $this->code)->first();

        $userGroups = auth()->user()->groups()->toArray();

        $userGroups = array_column($userGroups, 'id');

        if (in_array($group->id, $userGroups)) {
            $this->addError('code', 'You already joined this group');

            return false;
        } else {
            $result = $group->members()->create([
                'user_id' => auth()->user()->id,
                'is_creator' => false,
            ]);

            $this->reset();

            if ($result) {
                return true;
            }
        }

        return false;
    }
}
