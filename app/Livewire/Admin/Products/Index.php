<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.products.index', [
            'products' => Product::withCount('variants')->latest()->paginate(10)
        ]);
    }
}
