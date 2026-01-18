<?php

namespace Database\Seeders;

use App\Enums\ProductCategory;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Milk Products
        $milk = Product::create([
            'name' => 'Fresh Cow Milk',
            'description' => 'Pure, organic fresh cow milk delivered daily.',
            'category' => ProductCategory::MILK,
            'brand' => 'FarmFresh',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $milk->id,
            'variant_name' => '500ml Pouch',
            'unit_size' => '500ml',
            'sku' => 'MLK-500',
            'retail_price' => 35.00,
            'bulk_price' => 32.00,
            'stock' => 100,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $milk->id,
            'variant_name' => '1 Ltr Pouch',
            'unit_size' => '1L',
            'sku' => 'MLK-1000',
            'retail_price' => 65.00,
            'bulk_price' => 60.00,
            'stock' => 100,
        ]);

        $buffaloMilk = Product::create([
            'name' => 'Buffalo Milk',
            'description' => 'Rich and creamy buffalo milk.',
            'category' => ProductCategory::MILK,
            'brand' => 'FarmFresh',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $buffaloMilk->id,
            'variant_name' => '1 Ltr Bottle',
            'unit_size' => '1L',
            'sku' => 'BMLK-1000',
            'retail_price' => 75.00,
            'bulk_price' => 70.00,
            'stock' => 50,
            'is_default' => true,
        ]);


        // 2. Water Products
        $water20 = Product::create([
            'name' => 'Mineral Water Jar',
            'description' => '20 Litre Mineral Water Jar for home and office.',
            'category' => ProductCategory::WATER,
            'brand' => 'Bisleri',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $water20->id,
            'variant_name' => '20 Ltr Jar',
            'unit_size' => '20L',
            'sku' => 'WAT-20L',
            'retail_price' => 90.00,
            'bulk_price' => 80.00,
            'stock' => 200,
            'is_default' => true,
        ]);

        $water1 = Product::create([
            'name' => 'Water Bottle Box',
            'description' => 'Box of 1 Litre Water Bottles (12 pcs).',
            'category' => ProductCategory::WATER,
            'brand' => 'Kinley',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $water1->id,
            'variant_name' => '1 Ltr x 12 Box',
            'unit_size' => '12x1L',
            'sku' => 'WAT-BOX-1L',
            'retail_price' => 240.00,
            'bulk_price' => 220.00,
            'stock' => 50,
            'is_default' => true,
        ]);


        // 3. Beverages
        $coke = Product::create([
            'name' => 'Coca Cola',
            'description' => 'Refreshing soft drink.',
            'category' => ProductCategory::BEVERAGES,
            'brand' => 'Coca Cola',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $coke->id,
            'variant_name' => '750ml Bottle',
            'unit_size' => '750ml',
            'sku' => 'COKE-750',
            'retail_price' => 45.00,
            'bulk_price' => 40.00,
            'stock' => 100,
            'is_default' => true,
        ]);

        ProductVariant::create([
            'product_id' => $coke->id,
            'variant_name' => '2.25L Bottle',
            'unit_size' => '2.25L',
            'sku' => 'COKE-2250',
            'retail_price' => 95.00,
            'bulk_price' => 90.00,
            'stock' => 50,
        ]);

        $juice = Product::create([
            'name' => 'Mango Juice',
            'description' => 'Real mango pulp juice without preservatives.',
            'category' => ProductCategory::BEVERAGES,
            'brand' => 'Real',
            'is_active' => true,
        ]);

        ProductVariant::create([
            'product_id' => $juice->id,
            'variant_name' => '1 Ltr Tetrapack',
            'unit_size' => '1L',
            'sku' => 'JUC-MAN-1L',
            'retail_price' => 110.00,
            'bulk_price' => 100.00,
            'stock' => 80,
            'is_default' => true,
        ]);
    }
}
