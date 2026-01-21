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
                @foreach ($orders as $order)
                    <div
                        class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                        <!-- LEFT -->
                        <div class="space-y-1">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-receipt text-gray-400"></i>
                                <p class="font-semibold text-sm">
                                    Order <span class="text-gray-500">#{{ $order->order_number }}</span>
                                </p>
                            </div>

                            <p class="text-xs text-gray-500">
                                <i class="fa-regular fa-calendar mr-1"></i>
                                Placed on {{ $order->created_at }}
                            </p>

                            <div>

                                <span
                                    class="inline-flex items-center gap-1 mt-2 text-xs px-3 py-1 rounded-full bg-orange-100 text-orange-600 font-semibold">
                                    <i class="fa-solid fa-clock"></i>
                                    Pending
                                </span>
                            </div>
                        </div>

                        <!-- RIGHT -->
                        <div class="text-right space-y-2">
                            <p class="font-bold text-lg">₹2,499</p>
                            <a href="#order-details"
                                class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
                                View Details
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                @endforeach



            </div>

        </main>
    </div>
</div>