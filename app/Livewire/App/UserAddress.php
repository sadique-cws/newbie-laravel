<?php

namespace App\Livewire\App;

use App\Models\Address;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserAddress extends Component
{
    public $addresses = [];

    public $showModal = false;
    public $editing = false;

    public $addressId;
    public $label, $line1, $line2, $city, $state, $pincode, $country = 'India', $phone;
    public $is_default = false;

    protected $rules = [
        'label' => 'required',
        'line1' => 'required',
        'city' => 'required',
        'state' => 'required',
        'pincode' => 'required',
        'phone' => 'required',
    ];

    public function mount()
    {
        $this->loadAddresses();
    }

    public function loadAddresses()
    {
        $this->addresses = Address::where('user_id', auth()->id())
            ->orderByDesc('is_default')
            ->latest()
            ->get();
    }

    public function openAdd()
    {
        $this->resetForm();
        $this->editing = false;
        $this->showModal = true;
    }

    public function openEdit($id)
    {
        $address = Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $this->fill($address->toArray());
        $this->addressId = $address->id;
        $this->editing = true;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->is_default) {
            Address::where('user_id', auth()->id())->update(['is_default' => false]);
        }

        Address::updateOrCreate(
            ['id' => $this->addressId],
            [
                'user_id' => auth()->id(),
                'label' => $this->label,
                'line1' => $this->line1,
                'line2' => $this->line2,
                'city' => $this->city,
                'state' => $this->state,
                'pincode' => $this->pincode,
                'country' => $this->country,
                'phone' => $this->phone,
                'is_default' => $this->is_default,
            ]
        );

        $this->closeModal();
        $this->loadAddresses();
    }

    public function delete($id)
    {
        Address::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        $this->loadAddresses();
    }

    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;
    }

    public function resetForm()
    {
        $this->reset([
            'addressId', 'label', 'line1', 'line2',
            'city', 'state', 'pincode', 'country',
            'phone', 'is_default'
        ]);
    }

    public function render()
    {
        return view('livewire.app.user-address');
    }
}
