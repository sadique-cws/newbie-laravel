<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.admin')]
#[Title('Review Retailer Applications')]
class ReviewApplyRetailer extends Component
{
    public $selectedUser;
    public $rejectReason = '';
    public $showModal = false;

    public function openModal($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
        $this->rejectReason = '';
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedUser = null;
    }

    public function approve()
    {
        $this->selectedUser->update([
            'role' => 'RETAILER',
            'apply_status' => 'VERIFIED',
            'rejection_reason' => null,
            'is_verified' => true,
        ]);

        $this->closeModal();
    }

    public function reject()
    {
        $this->validate([
            'rejectReason' => 'required|min:5',
        ]);

        $this->selectedUser->update([
            'apply_status' => 'REJECTED',
            'rejection_reason' => $this->rejectReason,
        ]);

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.review-apply-retailer', [
            'requests' => User::whereIn('apply_status', ['SUBMITTED', 'PENDING'])->get(),
        ]);
    }
}
