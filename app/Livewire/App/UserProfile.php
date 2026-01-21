<?php

namespace App\Livewire\App;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

#[Layout('layouts.app')]
class UserProfile extends Component
{
    public $name;
    public $email;
    public $phone;
    public $password;

    public function mount()
    {
        $user = auth()->user();

        $this->name  = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone ?? '';
    }

    protected function rules()
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|min:6',
        ];
    }

    public function updateProfile()
    {
        $this->validate();

        $user = auth()->user();

        $user->name  = $this->name;
        $user->email = $this->email;
        $user->phone = $this->phone;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->password = null;

        session()->flash('success', 'Profile updated successfully');
    }

    public function render()
    {
        return view('livewire.app.user-profile');
    }
}
