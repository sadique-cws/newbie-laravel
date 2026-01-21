<?php

namespace App\Livewire\Shop;

use App\Enums\ProductCategory;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.shop')]
#[Title('Newbie Service - Home')]
class Home extends Component
{
    public $selectedCategory = null;
    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function render()
    {
        $products = Product::with([
            'variants' => function ($query) {
                $query->where('is_active', true)->orderBy('retail_price');
            }
        ])
            ->where('is_active', true)
            ->when($this->selectedCategory, function ($query) {
                $query->where('category', $this->selectedCategory);
            })
            ->get()
            ->groupBy(fn($item) => $item->category->value);

        return view('livewire.shop.home', [
            'groupedProducts' => $products,
            'categories' => ProductCategory::cases(),
        ]);
    }
}
