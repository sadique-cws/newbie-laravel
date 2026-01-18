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
class Edit extends Component
{
    use WithFileUploads;

    public Product $product;

    // Product Fields
    public $name;
    public $description;
    public $brand;
    public $category;
    public $isActive;

    // Variant Fields
    public $variants = [];
    public $variantsToDelete = [];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->brand = $product->brand;
        $this->category = $product->category->value;
        $this->isActive = $product->is_active;

        foreach ($product->variants as $variant) {
            $this->variants[] = [
                'id' => $variant->id,
                'unit_size' => $variant->unit_size,
                'retail_price' => $variant->retail_price,
                'stock' => $variant->stock,
                'sku' => $variant->sku,
                'image' => null, // Placeholder
                'is_default' => $variant->is_default,
            ];
        }
    }

    public function addVariant()
    {
        $this->variants[] = [
            'id' => null, // New variant
            'unit_size' => '',
            'retail_price' => '',
            'stock' => 100,
            'sku' => '',
            'image' => null,
            'is_default' => false,
        ];
    }

    public function removeVariant($index)
    {
        $variant = $this->variants[$index];
        if (isset($variant['id'])) {
            $this->variantsToDelete[] = $variant['id'];
        }
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

        $this->product->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
            'description' => $this->description,
            'brand' => $this->brand,
            'category' => $this->category,
            'is_active' => $this->isActive,
        ]);

        // Delete removed variants
        if (!empty($this->variantsToDelete)) {
            ProductVariant::whereIn('id', $this->variantsToDelete)->delete();
        }

        // Update or Create variants
        foreach ($this->variants as $variantData) {
            $data = [
                'product_id' => $this->product->id,
                'variant_name' => $this->name . ' - ' . $variantData['unit_size'],
                'unit_size' => $variantData['unit_size'],
                'retail_price' => $variantData['retail_price'],
                'stock' => $variantData['stock'],
                'sku' => $variantData['sku'] ?: strtoupper(Str::slug($this->name . '-' . $variantData['unit_size'])),
                'is_default' => $variantData['is_default'] ?? false,
            ];

            if (isset($variantData['id'])) {
                ProductVariant::where('id', $variantData['id'])->update($data);
            } else {
                ProductVariant::create($data);
            }
        }

        return redirect()->route('admin.products.index');
    }

    public function render()
    {
        return view('livewire.admin.products.edit', [
            'categories' => ProductCategory::cases(),
        ]);
    }
}
