<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex gap-6">

        <!-- ===== SIDEBAR ===== -->
        @include('components.app.user-sidebar')

        <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 space-y-6">

            <!-- ===== PAGE HEADER ===== -->
            <div>
                <h1 class="text-2xl font-bold">My Orders</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Track and manage your orders
                </p>
            </div>

            <!-- ===== ORDERS LIST ===== -->
            <div class="space-y-4">

                <!-- ===== ORDER CARD ===== -->
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-5
                           flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <!-- LEFT -->
                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-gray-400"></i>
                            <p class="font-semibold text-sm">
                                Order <span class="text-gray-500">#ORD-1023</span>
                            </p>
                        </div>

                        <p class="text-xs text-gray-500">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            Placed on 12 Jan 2026
                        </p>

                        <span class="inline-flex items-center gap-1 mt-2 text-xs px-3 py-1 rounded-full
                                   bg-orange-100 text-orange-600 font-semibold">
                            <i class="fa-solid fa-clock"></i>
                            Pending
                        </span>
                    </div>

                    <!-- RIGHT -->
                    <div class="text-right space-y-2">
                        <p class="font-bold text-lg">₹2,499</p>
                        <a href="#order-details" class="inline-flex items-center gap-1 text-sm font-semibold
                                  text-blue-600 hover:underline">
                            View Details
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- ===== ORDER CARD ===== -->
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-5
                           flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-gray-400"></i>
                            <p class="font-semibold text-sm">
                                Order <span class="text-gray-500">#ORD-1019</span>
                            </p>
                        </div>

                        <p class="text-xs text-gray-500">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            Placed on 05 Jan 2026
                        </p>

                        <span class="inline-flex items-center gap-1 mt-2 text-xs px-3 py-1 rounded-full
                                   bg-emerald-100 text-emerald-600 font-semibold">
                            <i class="fa-solid fa-check"></i>
                            Delivered
                        </span>
                    </div>

                    <div class="text-right space-y-2">
                        <p class="font-bold text-lg">₹1,799</p>
                        <a href="#order-details" class="inline-flex items-center gap-1 text-sm font-semibold
                                  text-blue-600 hover:underline">
                            View Details
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- ===== ORDER CARD ===== -->
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-5
                           flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                    <div class="space-y-1">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-receipt text-gray-400"></i>
                            <p class="font-semibold text-sm">
                                Order <span class="text-gray-500">#ORD-1012</span>
                            </p>
                        </div>

                        <p class="text-xs text-gray-500">
                            <i class="fa-regular fa-calendar mr-1"></i>
                            Placed on 28 Dec 2025
                        </p>

                        <span class="inline-flex items-center gap-1 mt-2 text-xs px-3 py-1 rounded-full
                                   bg-red-100 text-red-600 font-semibold">
                            <i class="fa-solid fa-xmark"></i>
                            Cancelled
                        </span>
                    </div>

                    <div class="text-right space-y-2">
                        <p class="font-bold text-lg">₹899</p>
                        <a href="#order-details" class="inline-flex items-center gap-1 text-sm font-semibold
                                  text-blue-600 hover:underline">
                            View Details
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

            </div>

        </main>
    </div>
</div>