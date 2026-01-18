<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.shop')]
class ProductShow extends Component
{
    public Product $product;
    public $selectedVariantId;
    public $selectedVariant;

    public function mount(Product $product)
    {
        $this->product = $product->load(['variants' => function ($q) {
            $q->where('is_active', true)->orderBy('retail_price');
        }]);

        if ($this->product->variants->isNotEmpty()) {
            $this->selectedVariant = $this->product->variants->first();
            $this->selectedVariantId = $this->selectedVariant->id;
        }
    }

    public function updatedSelectedVariantId($value)
    {
        $this->selectedVariant = $this->product->variants->find($value);
    }

    public function render()
    {
        $relatedProducts = Product::query()
            ->where('category', $this->product->category)
            ->where('id', '!=', $this->product->id)
            ->where('is_active', true)
            ->with(['variants' => fn($q) => $q->where('is_active', true)->orderBy('retail_price')])
            ->take(4)
            ->get();

        return view('livewire.shop.product-show', [
            'relatedProducts' => $relatedProducts
        ])->title($this->product->name . ' - Newbie Service');
    }
}
