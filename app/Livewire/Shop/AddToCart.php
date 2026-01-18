<?php

namespace App\Livewire\Shop;

use Livewire\Component;

class AddToCart extends Component
{
    public $variantId;
    public $price;
    public $unitSize;

    public function mount($variantId, $price, $unitSize)
    {
        $this->variantId = $variantId;
        $this->price = $price;
        $this->unitSize = $unitSize;
    }

    public function add()
    {
        $this->dispatch('add-to-cart', variantId: $this->variantId);
    }

    public function render()
    {
        return view('livewire.shop.add-to-cart');
    }
}
