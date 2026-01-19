<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex gap-6">

        @include('components.app.user-sidebar')

        <!-- ================= MAIN CONTENT ================= -->
        <main class="flex-1 space-y-8">

            <!-- ===== WELCOME ===== -->
            <div>
                <h1 class="text-2xl font-bold">
                    Hello, {{ auth()->user()->name }} 👋
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                    Your account overview
                </p>
            </div>

            <!-- ===== STATS ===== -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

                <div class="rounded-2xl p-4 bg-blue-50 dark:bg-blue-900/30">
                    <i class="fa-solid fa-cart-shopping text-blue-600"></i>
                    <p class="text-xs text-gray-500 mt-2">Total Orders</p>
                    <h2 class="text-2xl font-bold mt-1">12</h2>
                </div>

                <div class="rounded-2xl p-4 bg-orange-50 dark:bg-orange-900/30">
                    <i class="fa-solid fa-clock text-orange-500"></i>
                    <p class="text-xs text-gray-500 mt-2">Pending</p>
                    <h2 class="text-2xl font-bold mt-1 text-orange-600">3</h2>
                </div>

                <div class="rounded-2xl p-4 bg-pink-50 dark:bg-pink-900/30">
                    <i class="fa-solid fa-heart text-pink-500"></i>
                    <p class="text-xs text-gray-500 mt-2">Wishlist</p>
                    <h2 class="text-2xl font-bold mt-1 text-pink-600">8</h2>
                </div>

                <div class="rounded-2xl p-4 bg-emerald-50 dark:bg-emerald-900/30">
                    <i class="fa-solid fa-location-dot text-emerald-500"></i>
                    <p class="text-xs text-gray-500 mt-2">Addresses</p>
                    <h2 class="text-2xl font-bold mt-1 text-emerald-600">2</h2>
                </div>

            </div>

            <!-- ===== RECENT ORDERS ===== -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-5">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-lg">Recent Orders</h2>
                    <a href="{{ route('myorders') }}" class="text-sm font-semibold text-blue-600 hover:underline">
                        View all
                    </a>
                </div>

                <div class="space-y-3">

                    <div class="flex justify-between items-center border dark:border-gray-700 rounded-xl p-4">
                        <div>
                            <p class="font-semibold text-sm">#ORD-1023</p>
                            <p class="text-xs text-gray-500">12 Jan 2026</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-sm">₹2,499</p>
                            <span class="text-xs px-3 py-1 rounded-full
                                       bg-orange-100 text-orange-600 font-semibold">
                                Pending
                            </span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border dark:border-gray-700 rounded-xl p-4">
                        <div>
                            <p class="font-semibold text-sm">#ORD-1019</p>
                            <p class="text-xs text-gray-500">05 Jan 2026</p>
                        </div>
                        <div class="text-right">
                            <p class="font-semibold text-sm">₹1,799</p>
                            <span class="text-xs px-3 py-1 rounded-full
                                       bg-emerald-100 text-emerald-600 font-semibold">
                                Delivered
                            </span>
                        </div>
                    </div>

                </div>

            </div>

        </main>

    </div>
</div>