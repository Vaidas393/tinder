<?php

namespace App\Livewire\AccountSetup;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class Step5 extends Component
{
    use WithFileUploads;

    public $photo1;
    public $photo2;
    public $photo3;

    protected function rules()
    {
        return [
            'photo1' => 'required|image|mimes:jpg,jpeg,png|max:25600', // max 25MB
            'photo2' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
            'photo3' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function submit()
    {
        $this->validate();

        // Compress and store uploaded images
        $photo1Path = $this->storeCompressed($this->photo1, 'photo1');
        $photo2Path = $this->photo2 ? $this->storeCompressed($this->photo2, 'photo2') : null;
        $photo3Path = $this->photo3 ? $this->storeCompressed($this->photo3, 'photo3') : null;

        // Retrieve all previous steps data from session
        $step1 = Session::get('signup.step1');
        $step2 = Session::get('signup.step2');
        $step3 = Session::get('signup.step3');
        $step4 = Session::get('signup.step4');

        // Create final user
        $user = User::create([
            'username' => $step1['username'],
            'email'    => $step1['email'],
            'password' => bcrypt($step1['password']),
            'city'     => $step2['city'],
            'gender'   => $step3['gender'],
            'age'      => $step4['age'],
            'height'   => $step4['height'],
            'weight'   => $step4['weight'],
            'size'     => $step4['size'],
            'position' => $step4['position'],
            'photo1'   => $photo1Path,
            'photo2'   => $photo2Path,
            'photo3'   => $photo3Path,
        ]);

        // Login newly registered user
        auth()->login($user);

        // Clean registration session
        Session::forget('signup');

        return redirect()->route('dashboard');
    }

    private function storeCompressed($photo, $name)
    {
        $filename = $name . '_' . uniqid() . '.jpg';
        $directory = storage_path('app/public/users');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        // Use Intervention Image V3 properly with GD driver
        $manager = new ImageManager(new Driver());
        $manager->read($photo->getRealPath())
                ->toJpeg(70)
                ->save($path);

        return 'users/' . $filename;
    }

    public function render()
    {
        return view('livewire.account-setup.step5')->layout('layouts.app');
    }
}
