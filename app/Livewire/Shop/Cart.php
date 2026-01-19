<?php

namespace App\Livewire\Shop;

use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On;
use Livewire\Component;

class Cart extends Component
{
    public $cart = [];
    public $isOpen = false;
    public $total = 0;

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        $this->calculateTotal();
        // if (auth()->check()) {
        //     $this->mergeSessionCart();
        // }
    }

    #[On('open-cart')]
    public function openCart()
    {
        $this->isOpen = true;
    }

    #[On('add-to-cart')]
    public function addToCart($variantId, $quantity = 1)
    {
        $variant = ProductVariant::with('product')->find($variantId);

        if (!$variant) {
            return;
        }

        if (isset($this->cart[$variantId])) {
            $this->cart[$variantId]['quantity'] += $quantity;
        } else {
            $this->cart[$variantId] = [
                'id' => $variant->id,
                'name' => $variant->product->name . ' - ' . $variant->variant_name,
                'price' => $variant->retail_price,
                'unit_size' => $variant->unit_size,
                'image_url' => $variant->image_url,
                'quantity' => $quantity,
                'brand' => $variant->product->brand
            ];
        }

        Session::put('cart', $this->cart);
        $this->calculateTotal();
        // $this->isOpen = true; // Don't open drawer automatically

        $this->dispatch('cart-updated', count($this->cart));
    }
    public function mergeSessionCart()
    {
        // dd($this->cart);
        $sessionCart = $this->cart;
        if (!empty($sessionCart)) {
            foreach ($sessionCart as $productId => $item) {
                // dd($item);
                $variant = ProductVariant::with('product')->find($productId);
                $cartItem = OrderItem::firstOrCreate([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'variant_id' => $variant->id,
                    'variant_name' => "fchgvhjbk",
                    'product_name' => $variant->product->name,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],

                ]);
            }
        }
    }
    public function removeFromCart($variantId)
    {
        if (isset($this->cart[$variantId])) {
            unset($this->cart[$variantId]);
            Session::put('cart', $this->cart);
            $this->calculateTotal();
            $this->dispatch('cart-updated', count($this->cart));
        }
    }

    public function updateQuantity($variantId, $change)
    {
        if (isset($this->cart[$variantId])) {
            $this->cart[$variantId]['quantity'] += $change;

            if ($this->cart[$variantId]['quantity'] <= 0) {
                $this->removeFromCart($variantId);
            } else {
                Session::put('cart', $this->cart);
                $this->calculateTotal();
            }
        }

        $this->dispatch('cart-updated');
    }


    public function calculateTotal()
    {
        $this->itemsTotal = array_reduce($this->cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        $this->deliveryCharge = 15; // Fixed for now
        $this->grandTotal = $this->itemsTotal + $this->deliveryCharge;
    }

    public $itemsTotal = 0;
    public $deliveryCharge = 0;
    public $grandTotal = 0;

    public function render()
    {
        return view('livewire.shop.cart');
    }
}
