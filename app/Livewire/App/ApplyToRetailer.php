<?php

namespace App\Livewire\App;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class ApplyToRetailer extends Component
{
    use WithFileUploads;

    public $avatar;
    public $aadhar_front;
    public $aadhar_back;
    public $aadhar_card;

    public $user;
    public $submitting = false;

    public function mount()
    {
        $this->user = Auth::user();
        $this->aadhar_card = $this->user->aadhar_card;
    }

    public function submit()
    {
        $this->submitting = true;

        $this->validate([
            'avatar' => 'required|image|max:2048',
            'aadhar_card' => 'required|min:12|max:12',
            'aadhar_front' => 'required|image|max:2048',
            'aadhar_back' => 'required|image|max:2048',
        ]);

        // 🔴 DELETE OLD FILES (IF EXISTS)
        if ($this->user->avatar_url && Storage::disk('public')->exists($this->user->avatar_url)) {
            Storage::disk('public')->delete($this->user->avatar_url);
        }

        if ($this->user->aadhar_card_front && Storage::disk('public')->exists($this->user->aadhar_card_front)) {
            Storage::disk('public')->delete($this->user->aadhar_card_front);
        }

        if ($this->user->aadhar_card_back && Storage::disk('public')->exists($this->user->aadhar_card_back)) {
            Storage::disk('public')->delete($this->user->aadhar_card_back);
        }

        // 🟢 STORE NEW FILES
        $this->user->update([
            'avatar_url' => $this->avatar->store('retailer/avatar', 'public'),
            'aadhar_card' => $this->aadhar_card,
            'aadhar_card_front' => $this->aadhar_front->store('retailer/aadhar', 'public'),
            'aadhar_card_back' => $this->aadhar_back->store('retailer/aadhar', 'public'),
            'apply_status' => 'PENDING',
            'rejection_reason' => null,
        ]);

        $this->user->refresh();
        $this->submitting = false;

        session()->flash('success', 'Your application has been submitted for verification.');
    }

    public function render()
    {
        return view('livewire.app.apply-to-retailer');
    }
}
