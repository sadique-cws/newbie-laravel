<div>
    <!-- Hero Section -->


    <!-- Categories -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">
        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Shop by category</h2>
        <div class="flex space-x-6 overflow-x-auto pb-4 scrollbar-hide">
            <!-- Milk -->
            <a href="{{ route('catalog', ['category' => 'milk']) }}" class="flex flex-col items-center group min-w-20">
                <div
                    class="w-20 h-20 rounded-2xl flex items-center justify-center mb-2 transition-colors bg-gray-100 group-hover:bg-purple-50">
                    <span class="text-3xl">🥛</span>
                </div>
                <span class="text-xs font-semibold text-gray-700 group-hover:text-purple-700">Milk</span>
            </a>

            <!-- Water -->
            <a href="{{ route('catalog', ['category' => 'water']) }}" class="flex flex-col items-center group min-w-20">
                <div
                    class="w-20 h-20 rounded-2xl flex items-center justify-center mb-2 transition-colors bg-gray-100 group-hover:bg-purple-50">
                    <span class="text-3xl">💧</span>
                </div>
                <span class="text-xs font-semibold text-gray-700 group-hover:text-purple-700">Water</span>
            </a>

            <!-- Beverages -->
            <a href="{{ route('catalog', ['category' => 'beverages']) }}"
                class="flex flex-col items-center group min-w-20">
                <div
                    class="w-20 h-20 rounded-2xl flex items-center justify-center mb-2 transition-colors bg-gray-100 group-hover:bg-purple-50">
                    <span class="text-3xl">☕</span>
                </div>
                <span class="text-xs font-semibold text-gray-700 group-hover:text-purple-700">Beverages</span>
            </a>
        </div>
    </div>

    <!-- Promo Banners -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Banner 1 -->
            <div
                class="bg-[#3B82F6] rounded-xl p-6 text-white relative overflow-hidden h-40 flex flex-col justify-center">
                <h3 class="font-bold text-lg mb-1 relative z-10">Fresh Milk Delivered</h3>
                <p class="text-blue-100 text-xs mb-4 relative z-10">Farm fresh goodness everyday</p>
                <button
                    class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-lg w-fit transition relative z-10 backdrop-blur-sm">Order
                    Now</button>
            </div>
            <!-- Banner 2 -->
            <div
                class="bg-[#06B6D4] rounded-xl p-6 text-white relative overflow-hidden h-40 flex flex-col justify-center">
                <h3 class="font-bold text-lg mb-1 relative z-10">Pure Natural Water</h3>
                <p class="text-cyan-100 text-xs mb-4 relative z-10">Stay hydrated with us</p>
                <button
                    class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-lg w-fit transition relative z-10 backdrop-blur-sm">Order
                    Now</button>
            </div>
            <!-- Banner 3 -->
            <div
                class="bg-[#F97316] rounded-xl p-6 text-white relative overflow-hidden h-40 flex flex-col justify-center">
                <h3 class="font-bold text-lg mb-1 relative z-10">Refreshing Beverages</h3>
                <p class="text-orange-100 text-xs mb-4 relative z-10">Juices, sodas & energy drinks</p>
                <button
                    class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold px-4 py-1.5 rounded-lg w-fit transition relative z-10 backdrop-blur-sm">Order
                    Now</button>
            </div>
        </div>
    </div>

    <!-- Grouped Sections -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-12">
        @foreach($groupedProducts as $category => $products)
            <div id="category-{{ strtolower($category) }}">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                        {{ ucfirst(strtolower(($category == 'MILK' ? 'Milk & Dairy' : ($category == 'WATER' ? 'Water' : 'Beverages & Water')))) }}
                    </h2>
                    <a href="#" class="text-purple-600 font-bold text-xs uppercase tracking-wide hover:text-purple-700">see
                        all</a>
                </div>

                <!-- Horizontal Scroll Container -->
                <div class="flex overflow-x-auto pb-8 -mx-4 px-4 space-x-4 scrollbar-hide">
                    @foreach($products as $product)
                                <div
                                    class="min-w-50 w-[200px] bg-white dark:bg-gray-800 rounded-xl p-3 shadow-sm hover:shadow-md transition-shadow duration-200 border border-gray-50 dark:border-gray-700 relative group">
                                    <!-- Discount Badge -->
                                    <div
                                        class="absolute top-0 left-0 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-br-lg rounded-tl-xl z-10 shadow-sm">
                                        13% OFF
                                    </div>

                                    <!-- Product Card Content -->
                                    <div x-data="{
                                        selectedVariant: {{ $product->variants->first()->id }},
                                        price: {{ $product->variants->first()->retail_price }},
                                        unit: '{{ $product->variants->first()->unit_size }}',
                                        image: '{{ $product->variants->first()->image_url ?? '' }}',
                                        variants: {{ $product->variants->map(fn($v) => [
                            'id' => $v->id,
                            'price' => $v->retail_price,
                            'unit' => $v->unit_size,
                            'image' => $v->image_url
                        ])->toJson() }}
                                    }" class="flex flex-col h-full">

                                        <!-- Image Area -->
                                        <div class="group h-32 w-full flex items-center justify-center mb-3 relative
                           rounded-lg bg-gray-50 dark:bg-gray-700/50 overflow-hidden">

                                            <!-- ===== WISHLIST BUTTON ===== -->
                                             <livewire:shop.wishlist-component :id="$product->id" />
                                            

                                            <!-- ===== IMAGE ===== -->
                                            <template x-if="image">
                                                <img :src="image"
                                                    class="h-full w-full object-cover transition duration-300 transform group-hover:scale-105"
                                                    alt="{{ $product->name }}">
                                            </template>

                                            <!-- ===== PLACEHOLDER ===== -->
                                            <template x-if="!image">
                                                <span class="text-4xl filter grayscale opacity-50">
                                                    @if($category == 'MILK') 🥛
                                                    @elseif($category == 'WATER') 💧
                                                    @else 🍹
                                                    @endif
                                                </span>
                                            </template>
                                        </div>


                                        <!-- Product Info -->
                                        <div class="flex flex-col flex-grow">
                                            <a href="{{ route('product.show', $product) }}"
                                                class="block group-hover:text-purple-600 transition-colors">
                                                <h3
                                                    class="text-sm font-bold text-gray-900 dark:text-gray-100 leading-tight mb-1 line-clamp-2 h-10">
                                                    {{ $product->name }}</h3>
                                            </a>
                                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2">
                                                <span x-text="unit"></span>
                                            </div>

                                            <!-- Variants / Price -->
                                            <div class="mt-auto pt-2 border-t border-gray-100 dark:border-gray-700/50">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex flex-col">
                                                        <span class="text-xs text-gray-400 line-through font-medium">₹<span
                                                                x-text="Math.round(price * 1.2)"></span></span>
                                                        <span class="text-base font-bold text-gray-900 dark:text-white">₹<span
                                                                x-text="price"></span></span>
                                                    </div>

                                                    <!-- Add Button -->
                                                    <button wire:click="$dispatch('add-to-cart', { variantId: selectedVariant })"
                                                        class="px-5 py-1.5 rounded-lg border border-purple-200 dark:border-purple-800 text-purple-600 dark:text-purple-400 font-bold text-xs uppercase hover:bg-purple-50 dark:hover:bg-purple-900/30 transition shadow-sm bg-white dark:bg-gray-800">
                                                        ADD
                                                    </button>
                                                </div>

                                                <!-- Variant Selection (Mini Pills) -->
                                                @if($product->variants->count() > 1)
                                                    <div class="flex items-center space-x-1 mt-3 overflow-x-auto scrollbar-hide">
                                                        <template x-for="variant in variants" :key="variant.id">
                                                            <button
                                                                @click="selectedVariant = variant.id; price = variant.price; unit = variant.unit; if(variant.image) image = variant.image;"
                                                                :class="selectedVariant == variant.id ? 'bg-purple-100 text-purple-700 ring-1 ring-purple-300' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'"
                                                                class="px-1.5 py-0.5 rounded text-[9px] font-bold whitespace-nowrap transition cursor-pointer">
                                                                <span x-text="variant.unit"></span>
                                                            </button>
                                                        </template>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <!-- Bottom Spacer for Mobile Nav -->
    <div class="h-20 md:hidden"></div>
</div>