<?php

namespace App\Livewire\AccountSetup;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Step4 extends Component
{
    public $age;
    public $height;
    public $weight;
    public $size;
    public $position;

    public function mount()
    {
        $stepData = Session::get('signup.step4', []);
        $this->age = $stepData['age'] ?? null;
        $this->height = $stepData['height'] ?? null;
        $this->weight = $stepData['weight'] ?? null;
        $this->size = $stepData['size'] ?? null;
        $this->position = $stepData['position'] ?? null;
    }

    protected function rules()
    {
        return [
            'age'      => 'required|integer|min:18|max:80',
            'height'   => 'required|numeric|min:100|max:250',
            'weight'   => 'required|numeric|min:30|max:250',
            'size'     => 'required|numeric|min:10|max:30',
            'position' => 'required|in:active,passive,versatile',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        Session::put('signup.step4', [
            'age'      => $this->age,
            'height'   => $this->height,
            'weight'   => $this->weight,
            'size'     => $this->size,
            'position' => $this->position,
        ]);

        return redirect()->route('account.setup.step5');
    }

    public function render()
    {
        return view('livewire.account-setup.step4')
            ->layout('layouts.app');
    }
}
