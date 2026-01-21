<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex gap-6">

        <!-- ===== SIDEBAR ===== -->
        @include('components.app.user-sidebar')

        <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 space-y-6">

            <!-- ===== PAGE HEADER ===== -->
            <div>
                <h1 class="text-2xl font-bold">My Wishlist</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Products you saved for later
                </p>
            </div>

            <!-- ================================================= -->
            <!-- ============ EMPTY STATE (NO WISHLIST) =========== -->
            <!-- ================================================= -->
            @if ($wishlists->count() == 0)
            
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-10 text-center border dark:border-gray-700">
                <i class="fa-regular fa-heart text-4xl text-gray-300 mb-4"></i>
                <h2 class="font-semibold text-lg">Your wishlist is empty</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Save products you like and come back later
                </p>
                <a href="{{ route('catalog') }}" class="inline-block mt-4 px-5 py-2 rounded-lg
                          bg-blue-600 text-white text-sm font-semibold">
                    Browse Products
                </a>
            </div>
            @endif
            <!-- ================================================= -->

            <!-- ===== WISHLIST GRID ===== -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

                <!-- ===== PRODUCT CARD ===== -->
                @foreach ($wishlists as $wishlist)

                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-3
                           hover:shadow-md transition">

                    <div class="h-32 bg-gray-100 dark:bg-gray-700 rounded-xl mb-3"></div>

                    <p class="text-sm font-semibold leading-tight">
                        Wireless Headphones
                    </p>

                    <p class="text-sm font-bold mt-1">₹1,999</p>

                    <div class="flex gap-2 mt-3">
                        <button class="flex-1 text-xs px-3 py-2 rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white font-semibold transition">
                            <i class="fa-solid fa-cart-plus mr-1"></i>
                            Add to Cart
                        </button>
                        <button wire:click="deleteWishlist({{ $wishlist->product_id }})" class="text-xs px-3 py-2 rounded-lg
                                   bg-gray-100 dark:bg-gray-700
                                   text-gray-600 dark:text-gray-300 font-semibold
                                   hover:bg-red-100 hover:text-red-600 transition">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
                @endforeach


            </div>

        </main>
    </div>
</div>