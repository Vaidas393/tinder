<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\City;

class EditProfile extends Component
{
    use WithFileUploads;

    public $user;
    public $cities = [];

    public $photo1, $photo2, $photo3;

    public $username, $email, $age, $city, $height, $weight, $size, $gender, $position, $language;
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $this->user = Auth::user();
        $this->cities = City::orderBy('name')->pluck('name')->toArray();

        $this->username = $this->user->username;
        $this->email = $this->user->email;
        $this->age = $this->user->age;
        $this->city = $this->user->city;
        $this->height = $this->user->height;
        $this->weight = $this->user->weight;
        $this->size = $this->user->size;
        $this->gender = $this->user->gender;
        $this->position = $this->user->position;
        $this->language = $this->user->language;
    }

    protected function rules()
    {
        return [
            'username' => 'required|string|max:255|unique:users,username,' . $this->user->id,
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'photo1' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
            'photo2' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
            'photo3' => 'nullable|image|mimes:jpg,jpeg,png|max:25600',
            'age' => 'nullable|integer|min:18|max:100',
            'city' => ['required', 'string', 'in:' . implode(',', $this->cities)],
            'height' => 'nullable|integer',
            'weight' => 'nullable|integer',
            'size' => 'nullable|integer',
            'gender' => 'nullable|in:male,female',
            'position' => 'nullable|in:active,passive,versatile',
            'language' => 'nullable|string|max:3',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function saveProfile()
    {
        $this->validate();

        // Delete old photos if uploading new ones
        if ($this->photo1 && $this->user->photo1) {
            Storage::disk('public')->delete($this->user->photo1);
        }
        if ($this->photo2 && $this->user->photo2) {
            Storage::disk('public')->delete($this->user->photo2);
        }
        if ($this->photo3 && $this->user->photo3) {
            Storage::disk('public')->delete($this->user->photo3);
        }

        // Upload new photos (or keep existing)
        $photo1Path = $this->photo1 ? $this->storeCompressed($this->photo1, 'photo1') : $this->user->photo1;
        $photo2Path = $this->photo2 ? $this->storeCompressed($this->photo2, 'photo2') : $this->user->photo2;
        $photo3Path = $this->photo3 ? $this->storeCompressed($this->photo3, 'photo3') : $this->user->photo3;

        // Prepare data
        $data = [
            'username' => $this->username,
            'email' => $this->email,
            'age' => $this->age,
            'city' => $this->city,
            'height' => $this->height,
            'weight' => $this->weight,
            'size' => $this->size,
            'gender' => $this->gender,
            'position' => $this->position,
            'language' => $this->language,
            'photo1' => $photo1Path,
            'photo2' => $photo2Path,
            'photo3' => $photo3Path,
        ];

        // Handle password change
        if ($this->new_password) {
            if (!Hash::check($this->current_password, $this->user->password)) {
                $this->addError('current_password', 'Current password is incorrect.');
                return;
            }
            $data['password'] = Hash::make($this->new_password);
        }

        $this->user->update($data);

        return redirect()->route('editProfile');
    }
    
    public function deletePhoto(string $photoKey)
    {
        if (!in_array($photoKey, ['photo1', 'photo2', 'photo3'])) {
            return;
        }

        if ($this->user->{$photoKey}) {
            // Delete file from storage
            Storage::disk('public')->delete($this->user->{$photoKey});

            // Remove from DB and reset Livewire state
            $this->user->update([$photoKey => null]);
            $this->{$photoKey} = null;
        }
    }

    public function deleteProfile()
    {
        foreach (['photo1', 'photo2', 'photo3'] as $field) {
            if ($this->user->{$field}) {
                Storage::disk('public')->delete($this->user->{$field});
            }
        }

        Auth::logout();
        $this->user->delete();

        return redirect()->route('home');
    }

    private function storeCompressed($photo, $name)
    {
        $filename = $name . '_' . uniqid() . '.jpg';
        $directory = storage_path('app/public/users');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $path = $directory . '/' . $filename;

        $manager = new ImageManager(new Driver());
        $manager->read($photo->getRealPath())
                ->toJpeg(80)
                ->save($path);

        return 'users/' . $filename;
    }

    public function render()
    {
        return view('livewire.edit-profile')->layout('layouts.app');
    }
}
