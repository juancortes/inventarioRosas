<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Rule;

class Code extends Component
{
    #[Rule('required')]
    public $code = '';

    public function render()
    {
        return view('livewire.code');
    }

    public function selectedName(): void
    {
        $this->dispatch('code-selected', selectedName: $this->code)
            ->to(Slug::class);
    }
}
