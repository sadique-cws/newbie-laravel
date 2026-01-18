<?php

namespace App\Livewire\Admin\Products;

use App\Enums\ProductCategory;
use App\Models\Product;
use App\Models\ProductVariant;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

#[Layout('layouts.admin')]
class Create extends Component
{
    use WithFileUploads;

    // Product Fields
    public $name;
    public $description;
    public $brand;
    public $category;
    public $isActive = true;

    // Variant Fields
    public $variants = [];

    public function mount()
    {
        // Initialize with one empty variant
        $this->addVariant();
    }

    public function addVariant()
    {
        $this->variants[] = [
            'unit_size' => '',
            'retail_price' => '',
            'stock' => 100,
            'sku' => '',
            'image' => null, // Placeholder for upload
            'is_default' => count($this->variants) === 0,
        ];
    }

    public function removeVariant($index)
    {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'brand' => 'required|string|max:255',
            'category' => 'required',
            'variants' => 'required|array|min:1',
            'variants.*.unit_size' => 'required|string',
            'variants.*.retail_price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.sku' => 'nullable|string',
        ]);

        $product = Product::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'brand' => $this->brand,
            'category' => $this->category,
            'is_active' => $this->isActive,
        ]);

        foreach ($this->variants as $variantData) {
            ProductVariant::create([
                'product_id' => $product->id,
                'variant_name' => $this->name . ' - ' . $variantData['unit_size'],
                'unit_size' => $variantData['unit_size'],
                'retail_price' => $variantData['retail_price'],
                'stock' => $variantData['stock'],
                'sku' => $variantData['sku'] ?: strtoupper(Str::slug($this->name . '-' . $variantData['unit_size'])),
                'is_default' => $variantData['is_default'] ?? false,
                // Handle image upload logic here later if needed (e.g. store path)
            ]);
        }

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.create', [
            'categories' => ProductCategory::cases(),
        ]);
    }
}
