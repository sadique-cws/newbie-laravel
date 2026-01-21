<div class="min-h-[calc(100vh-64px)] bg-gray-50/50 dark:bg-gray-900 flex">
    <!-- Sidebar -->
    <div
        class="w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-800 shrink-0 hidden md:block overflow-y-auto h-[calc(100vh-64px)] sticky top-16">
        <div class="p-6">
            <button wire:click="$set('category', null)"
                class="flex flex-col items-center justify-center w-full aspect-square border-2 rounded-xl mb-4 transition-all {{ is_null($category) ? 'border-purple-600 bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400' : 'border-gray-200 dark:border-gray-700 text-gray-400 hover:border-gray-300' }}">
                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span class="text-xs font-bold uppercase tracking-wide">All Products</span>
            </button>
            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mb-4 text-center">Select Category
            </div>

            <div class="space-y-4">
                @foreach($categories as $cat)
                    <button wire:click="$set('category', '{{ strtolower($cat->value) }}')"
                        class="w-full text-left px-4 py-3 rounded-lg flex items-center justify-between group transition-colors {{ $category == strtolower($cat->value) ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-700 dark:text-purple-400' : 'hover:bg-gray-50 dark:hover:bg-gray-700/50 text-gray-600 dark:text-gray-400' }}">
                        <span class="font-bold text-sm">{{ ucfirst(strtolower($cat->value)) }}</span>
                        @if($cat->value == 'MILK') <span class="text-lg">🥛</span>
                        @elseif($cat->value == 'WATER') <span class="text-lg">💧</span>
                        @elseif($cat->value == 'BEVERAGES') <span class="text-lg">🍹</span>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 md:p-8">
        <!-- Mobile Category Nav -->
        <div class="md:hidden mb-6 overflow-x-auto pb-2 -mx-6 px-6 scrollbar-hide">
            <div class="flex space-x-4">
                <button wire:click="$set('category', null)" class="flex flex-col items-center min-w-[60px] group">
                    <div
                        class="w-12 h-12 rounded-xl flex items-center justify-center mb-1 transition-colors border {{ is_null($category) ? 'bg-purple-50 border-purple-200 text-purple-600' : 'bg-white border-gray-100 text-gray-400' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </div>
                    <span
                        class="text-[10px] font-bold {{ is_null($category) ? 'text-purple-700' : 'text-gray-500' }}">All</span>
                </button>
                @foreach($categories as $cat)
                    <button wire:click="$set('category', '{{ strtolower($cat->value) }}')"
                        class="flex flex-col items-center min-w-[60px] group">
                        <div
                            class="w-12 h-12 rounded-xl flex items-center justify-center mb-1 transition-colors border {{ $category == strtolower($cat->value) ? 'bg-purple-50 border-purple-200' : 'bg-white border-gray-100 hover:bg-gray-50' }}">
                            <span class="text-xl">
                                @if($cat->value == 'MILK') 🥛
                                @elseif($cat->value == 'WATER') 💧
                                @elseif($cat->value == 'BEVERAGES') 🍹
                                @endif
                            </span>
                        </div>
                        <span
                            class="text-[10px] font-bold {{ $category == strtolower($cat->value) ? 'text-purple-700' : 'text-gray-500' }}">{{ ucfirst(strtolower($cat->value)) }}</span>
                    </button>
                @endforeach
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                @if($search)
                    <span class="text-gray-400 mr-2 font-medium">Search:</span> "{{ $search }}"
                @elseif($category)
                    {{ ucfirst(strtolower($category)) }}
                @else
                    All Products
                @endif
            </h1>

            <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wide whitespace-nowrap mr-2">Sort
                    By</span>
                <button wire:click="$set('sort', 'newest')"
                    class="px-3 py-1.5 rounded border text-xs font-bold transition whitespace-nowrap {{ $sort == 'newest' ? 'bg-purple-100 text-purple-700 border-purple-200' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Newest</button>
                <button wire:click="$set('sort', 'price_low')"
                    class="px-3 py-1.5 rounded border text-xs font-bold transition whitespace-nowrap {{ $sort == 'price_low' ? 'bg-purple-100 text-purple-700 border-purple-200' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Price
                    Low to High</button>
                <button wire:click="$set('sort', 'price_high')"
                    class="px-3 py-1.5 rounded border text-xs font-bold transition whitespace-nowrap {{ $sort == 'price_high' ? 'bg-purple-100 text-purple-700 border-purple-200' : 'bg-white border-gray-200 text-gray-600 hover:bg-gray-50' }}">Price
                    High to Low</button>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="flex flex-col items-center justify-center min-h-[400px] text-center">
                <div class="w-24 h-24 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No products found</h3>
                <p class="text-gray-500 max-w-sm mx-auto mb-8">Try changing the category or filter to find what you're
                    looking for.</p>

                <button wire:click="clearFilters"
                    class="px-6 py-2.5 bg-[#A855F7] hover:bg-[#9333EA] text-white font-bold rounded-lg shadow-lg shadow-purple-200 dark:shadow-none transition active:scale-95">
                    Clear Filters
                </button>
            </div>
        @else
            <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 md:gap-6">
                @foreach($products as $product)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md transition duration-200 border border-gray-100 dark:border-gray-800 flex flex-col h-full group">
                        <!-- Image Area -->
                        <div
                            class="h-40 w-full flex items-center justify-center bg-gray-50 dark:bg-gray-900/50 relative overflow-hidden rounded-t-xl">
                            <!-- Discount Badge Placeholder -->
                            <div
                                class="absolute top-0 left-0 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-br-lg z-10">
                                13% OFF
                            </div>
                            <livewire:shop.wishlist-component :id="$product->id" />
                            @if($product->variants->first()->image_url)
                                <img src="{{ $product->variants->first()->image_url }}" alt="{{ $product->name }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <span
                                    class="text-5xl filter grayscale opacity-50 transition duration-300 group-hover:scale-110 group-hover:filter-none group-hover:opacity-100">
                                    @if($product->category->value == 'MILK') 🥛
                                    @elseif($product->category->value == 'WATER') 💧
                                    @elseif($product->category->value == 'BEVERAGES') 🍹
                                    @endif
                                </span>
                            @endif
                        </div>

                        <div class="p-4 flex flex-col flex-1">
                            <div class="text-[10px] text-blue-600 font-bold uppercase tracking-wider mb-1">{{ $product->brand }}
                            </div>
                            <a href="{{ route('product.show', $product) }}"
                                class="block group-hover:text-purple-600 transition-colors">
                                <h3
                                    class="text-sm font-bold text-gray-900 dark:text-white leading-snug mb-2 line-clamp-2 min-h-[2.5em]">
                                    {{ $product->name }}</h3>
                            </a>

                            <div x-data="{ 
                                selectedVariantId: '{{ $product->variants->first()->id }}',
                                price: '{{ $product->variants->first()->retail_price }}',
                                unit: '{{ $product->variants->first()->unit_size }}'
                            }" class="mt-auto">

                                <div
                                    class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100 dark:border-gray-700/50">
                                    <div>
                                        <span class="text-[10px] text-gray-400 line-through block">₹<span
                                                x-text="Math.round(price * 1.15)"></span></span>
                                        <span class="text-base font-extrabold text-gray-900 dark:text-white">₹<span
                                                x-text="price"></span></span>
                                    </div>

                                    <button wire:click="$dispatch('add-to-cart', { variantId: selectedVariantId })"
                                        class="px-4 py-1.5 bg-white border border-purple-200 text-purple-600 font-bold text-xs rounded-lg hover:bg-purple-50 transition uppercase tracking-wide shadow-sm hover:shadow active:scale-95">
                                        Add
                                    </button>
                                </div>

                                @if($product->variants->count() > 1)
                                    <div class="flex gap-1 mt-3 overflow-x-auto scrollbar-hide py-1">
                                        @foreach($product->variants as $variant)
                                            <button
                                                @click="selectedVariantId = '{{ $variant->id }}'; price = '{{ $variant->retail_price }}'; unit = '{{ $variant->unit_size }}'"
                                                :class="selectedVariantId == '{{ $variant->id }}' ? 'bg-purple-100 text-purple-700 ring-1 ring-purple-300' : 'bg-gray-100 text-gray-500 hover:bg-gray-200'"
                                                class="px-2 py-0.5 rounded text-[10px] font-bold whitespace-nowrap transition">
                                                {{ $variant->unit_size }}
                                            </button>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="mt-3 h-6 flex items-center">
                                        <span
                                            class="text-[10px] font-bold bg-gray-100 text-gray-500 px-2 py-0.5 rounded">{{ $product->variants->first()->unit_size }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>