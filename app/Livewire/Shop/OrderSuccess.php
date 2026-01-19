<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

#[Layout('layouts.shop')]
#[Title('Newbie Service - Checkout')]
class OrderSuccess extends Component
{
    public $orderId;

    public function mount($order)
    {
        $this->orderId = $order;
    }

    public function render()
    {
        return view('livewire.shop.order-success');
    }
}
