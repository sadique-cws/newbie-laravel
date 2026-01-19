<?php

namespace App\Livewire\Shop;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.shop')]
#[Title('Newbie Service - Checkout')]
class Checkout extends Component
{
    public $cart = [];
    public $itemsTotal = 0;
    public $deliveryCharge = 15;
    public $grandTotal = 0;

    public $addresses = [];
    public $selectedAddress = null;

    public $showAddressForm = false;
    public $editingAddressId = null;

    // address fields
    public $label, $line1, $line2, $city, $state, $pincode, $phone;


    public function mount()
    {
        $this->loadCart();
        $this->loadAddresses();
        if ($this->itemsTotal === 0) {
            return redirect()->route('home');
        }

    }

    #[On('cart-updated')]
    public function refreshCheckoutCart()
    {
        $this->loadCart();
    }


    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->itemsTotal = collect($this->cart)->sum(
            fn($item) => $item['price'] * $item['quantity']
        );

        $this->grandTotal = $this->itemsTotal + $this->deliveryCharge;
    }


    public function loadAddresses()
    {
        $this->addresses = Address::where('user_id', Auth::id())
            ->orderByDesc('is_default')
            ->get();

        // if (!$this->selectedAddress) {
        //     $this->selectedAddress = $this->addresses->first()?->id;
        // }
    }

    public function addNewAddress()
    {
        $this->resetAddressForm();
        $this->showAddressForm = true;
    }

    public function editAddress($id)
    {
        $address = Address::where('user_id', Auth::id())->findOrFail($id);

        $this->editingAddressId = $address->id;
        $this->label = $address->label;
        $this->line1 = $address->line1;
        $this->line2 = $address->line2;
        $this->city = $address->city;
        $this->state = $address->state;
        $this->pincode = $address->pincode;
        $this->phone = $address->phone;

        $this->showAddressForm = true;
    }

    public function saveAddress()
    {
        $this->validate([
            'label' => 'required',
            'line1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'phone' => 'required',
        ]);

        if ($this->editingAddressId) {
            Address::where('id', $this->editingAddressId)
                ->where('user_id', Auth::id())
                ->update([
                    'label' => $this->label,
                    'line1' => $this->line1,
                    'line2' => $this->line2,
                    'city' => $this->city,
                    'state' => $this->state,
                    'pincode' => $this->pincode,
                    'phone' => $this->phone,
                ]);
        } else {
            $address = Address::create([
                'user_id' => Auth::id(),
                'label' => $this->label,
                'line1' => $this->line1,
                'line2' => $this->line2,
                'city' => $this->city,
                'state' => $this->state,
                'pincode' => $this->pincode,
                'phone' => $this->phone,
                'is_default' => true,
            ]);

            Address::where('user_id', Auth::id())
                ->where('id', '!=', $address->id)
                ->update(['is_default' => false]);

            $this->selectedAddress = $address->id;
        }

        $this->resetAddressForm();
        $this->loadAddresses();
    }

    public function resetAddressForm()
    {
        $this->reset([
            'label',
            'line1',
            'line2',
            'city',
            'state',
            'pincode',
            'phone'
        ]);

        $this->editingAddressId = null;
        $this->showAddressForm = false;
    }


    public function placeOrder()
    {
        if (!$this->selectedAddress) {
            $this->addError('selectedAddress', 'Please select address');
            return;
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $this->selectedAddress,
            'total_amount' => $this->grandTotal,
            'subtotal' => $this->itemsTotal,
            'discount' => 0,
            'delivery_fee' => $this->deliveryCharge,
            'order_number' => $this->generateOrderNumber(),
        ]);

        session()->forget('cart');

        return redirect()->route('ordersuccess', [
            'order' => $order->order_number
        ]);
    }
    private function generateOrderNumber()
    {
        do {
            $orderNumber = 'NB' . rand(10000000, 99999999);
        } while (Order::where('order_number', $orderNumber)->exists());

        return $orderNumber;
    }

    public function render()
    {
        return view('livewire.shop.checkout');
    }
}
