<?php

namespace App\Livewire\Shop;

use App\Enums\ProductCategory;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.shop')]
#[Title('Newbie Service - Catalog')]
class Catalog extends Component
{
    use WithPagination;

    #[Url]
    public $category = null;

    #[Url]
    public $search = '';

    #[Url]
    public $sort = 'newest';

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
        $this->search = '';
    }

    public function clearFilters()
    {
        $this->reset(['category', 'search', 'sort']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query()
            ->where('is_active', true)
            ->with(['variants' => fn($q) => $q->where('is_active', true)->orderBy('retail_price')]);
        // Use subquery to get min price for sorting
        // ->withMin('variants', 'retail_price'); // This only adds it to the model, doesn't allow easy sorting on the builder without tweaks in some versions.
        // Simpler approach for sorting: join.

        // We need to add the min_price to use it for sorting
        $query->withAggregate('variants as min_price', 'retail_price', 'min');

        if ($this->category) {
            // Support lowercase slug from URL by converting to Title Case enum backing value
            $categoryValue = ucfirst(strtolower($this->category));
            $categoryEnum = ProductCategory::tryFrom($categoryValue);

            if ($categoryEnum) {
                $query->where('category', $categoryEnum);
            }
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        switch ($this->sort) {
            case 'price_low':
                $query->orderBy('min_price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('min_price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        return view('livewire.shop.catalog', [
            'products' => $query->paginate(12),
            'categories' => ProductCategory::cases(),
        ]);
    }
}
