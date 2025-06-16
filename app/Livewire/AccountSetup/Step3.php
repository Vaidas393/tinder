<?php

namespace App\Livewire\AccountSetup;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Step3 extends Component
{
    public $gender;

    public function mount()
    {
        if (!Session::has('signup.step1') || !Session::has('signup.step2')) {
            return redirect()->route('register');
        }

        // Optional: Pre-fill gender if user comes back to step 3
        $step3 = Session::get('signup.step3', []);
        $this->gender = $step3['gender'] ?? null;
    }

    protected function rules(): array
    {
        return [
            'gender' => 'required|in:male,female',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        // ✅ Store gender into session
        Session::put('signup.step3', [
            'gender' => $this->gender,
        ]);

        return redirect()->route('account.setup.step4');
    }

    public function render()
    {
        return view('livewire.account-setup.step3')->layout('layouts.app');
    }
}
