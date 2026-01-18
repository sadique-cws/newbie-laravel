<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="lg:grid lg:grid-cols-2 lg:gap-x-12 xl:gap-x-16">
        <!-- Image Gallery -->
        <div class="product-image-gallery flex flex-col-reverse lg:flex-row gap-4">
            <!-- Thumbnails (To be implemented with real images later) -->
            <div class="hidden lg:flex flex-col gap-4 w-20">
                @if($selectedVariant && $selectedVariant->image_url)
                <button class="w-full aspect-square rounded-lg border-2 border-purple-600 p-1 overflow-hidden">
                    <img src="{{ $selectedVariant->image_url }}" class="w-full h-full object-cover rounded-md" alt="">
                </button>
                @else
                <button class="w-full aspect-square rounded-lg border-2 border-purple-600 p-1 flex items-center justify-center bg-gray-50 dark:bg-gray-800 text-xl">
                    @if($product->category->value == 'MILK') 🥛
                    @elseif($product->category->value == 'WATER') 💧
                    @elseif($product->category->value == 'BEVERAGES') 🍹
                    @endif
                </button>
                @endif
            </div>

            <!-- Main Image -->
            <div class="w-full aspect-square rounded-2xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-800 flex items-center justify-center relative overflow-hidden shadow-sm">
                @if($selectedVariant && $selectedVariant->image_url)
                <img src="{{ $selectedVariant->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @else
                <span class="text-9xl filter drop-shadow-lg opacity-80 animate-pulse-slow">
                    @if($product->category->value == 'MILK') 🥛
                    @elseif($product->category->value == 'WATER') 💧
                    @elseif($product->category->value == 'BEVERAGES') 🍹
                    @endif
                </span>
                @endif

                <div class="absolute top-4 left-4">
                    <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                        In Stock
                    </span>
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white sm:text-4xl">{{ $product->name }}</h1>

            <div class="mt-3">
                <h2 class="sr-only">Product information</h2>
                <div class="flex items-baseline gap-4">
                    <p class="text-3xl text-gray-900 dark:text-white font-bold">₹{{ number_format($selectedVariant->retail_price ?? 0) }}</p>
                    <p class="text-lg text-gray-500 line-through">₹{{ number_format(($selectedVariant->retail_price ?? 0) * 1.15) }}</p>
                    <span class="text-green-600 font-bold text-sm bg-green-100 px-2 py-0.5 rounded">15% OFF</span>
                </div>
                <p class="text-sm text-gray-500 mt-1 font-medium">Inclusive of all taxes</p>
            </div>

            <div class="mt-6">
                <h3 class="sr-only">Description</h3>
                <div class="text-base text-gray-700 dark:text-gray-300 space-y-6">
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <div class="mt-6 border-t border-gray-100 dark:border-gray-700 pt-6">
                <div class="flex items-center gap-2 mb-4">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">Brand:</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        {{ $product->brand }}
                    </span>
                </div>

                <div class="mt-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">Available Sizes</h3>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 gap-3 mt-4">
                        @foreach($product->variants as $variant)
                        <button type="button"
                            wire:click="$set('selectedVariantId', {{ $variant->id }})"
                            class="border rounded-lg py-3 px-3 flex items-center justify-center text-sm font-medium uppercase sm:flex-1 cursor-pointer focus:outline-none transition-all {{ $selectedVariantId == $variant->id ? 'ring-2 ring-purple-600 border-transparent bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300' : 'border-gray-200 text-gray-900 hover:bg-gray-50 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800' }}">
                            <span id="size-choice-0-label">{{ $variant->unit_size }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>

                <div class="mt-10 flex sm:flex-col1">
                    <button type="button"
                        wire:click="$dispatch('add-to-cart', { variantId: {{ $selectedVariantId }} })"
                        class="w-full bg-[#A855F7] border border-transparent rounded-xl py-4 flex items-center justify-center text-base font-bold text-white hover:bg-[#9333EA] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-lg shadow-purple-200 dark:shadow-none transition transform active:scale-[0.99]">
                        Add to Cart - ₹{{ number_format($selectedVariant->retail_price ?? 0) }}
                    </button>
                </div>

                <div class="mt-8 flex items-center justify-center gap-8 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Authentic Products</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Fast Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>