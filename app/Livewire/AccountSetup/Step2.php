<?php

namespace App\Livewire\AccountSetup;

use Livewire\Component;
use App\Models\City;
use Illuminate\Support\Facades\Session;

class Step2 extends Component
{
    public $cities = [];
    public $search = '';
    public $city = null;

    public function mount()
    {
        if (!Session::has('signup.step1')) {
            return redirect()->route('register');
        }

        $this->cities = City::orderBy('name')->pluck('name')->toArray();
    }

    public function getFilteredCitiesProperty()
    {
        if (empty($this->search)) {
            return $this->cities;
        }

        return array_filter($this->cities, function ($name) {
            return str_contains(strtolower($name), strtolower($this->search));
        });
    }

    public function submit()
    {
        $this->validate([
            'city' => ['required', 'string', 'in:' . implode(',', $this->cities)],
        ]);

        // ✅ Store city in session
        Session::put('signup.step2', [
            'city' => $this->city,
        ]);

        return redirect()->route('account.setup.step3');
    }

    public function render()
    {
        return view('livewire.account-setup.step2', [
            'filteredCities' => $this->filteredCities,
        ])->layout('layouts.app');
    }
}
