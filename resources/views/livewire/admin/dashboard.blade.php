<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Welcome Back, Admin</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-2">Here's what's happening in your store today.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Stat Card 1 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-blue-100 dark:bg-blue-900 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Orders</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalOrders }}</p>
                <!-- <span class="text-xs text-green-500 font-medium mt-2 inline-flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    12% increase 
                </span> -->
            </div>

            <!-- Stat Card 2 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Revenue</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">₹{{ $totalRevenue }}</p>
                <!-- <span class="text-xs text-green-500 font-medium mt-2 inline-flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                    </svg>
                    8% increase
                </span> -->
            </div>

            <!-- Stat Card 3 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-yellow-100 dark:bg-yellow-900 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Customers</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalCustomer }}</p>
                <!-- <span class="text-xs text-red-500 font-medium mt-2 inline-flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                    2% decrease
                </span> -->
            </div>

            <!-- Stat Card 4 -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-6 border border-gray-100 dark:border-gray-700 transition hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-pink-100 dark:bg-pink-900 rounded-lg">
                        <svg class="w-6 h-6 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Pending KYC</h3>
                <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $unVerifiedRetailer }}</p>
                <!-- <span class="text-xs text-gray-400 font-medium mt-2">Requires attention</span> -->
            </div>
        </div>

        <!-- Recent Activity / Table Placeholder -->
        <div
            class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">Recent Orders</h3>
                <!-- Placeholder for table -->
                <div class="space-y-4">

                    @foreach ($recentOrder as $order)
                                    <div
                                        class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl py-5 px-5 space-y-4 shadow-sm hover:shadow-md transition">

                                        <!-- TOP -->
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                            <div>
                                                <div class="flex items-center gap-2">
                                                    <i class="fa-solid fa-receipt text-gray-400"></i>
                                                    <p class="font-semibold text-sm">
                                                        Order <span class="text-gray-500">#{{ $order->order_number }}</span>
                                                    </p>
                                                </div>

                                                <p class="text-xs text-gray-500 mt-1">
                                                    <i class="fa-regular fa-calendar mr-1"></i>
                                                    {{ $order->created_at->format('d M Y, h:i A') }}
                                                </p>
                                            </div>

                                            <!-- STATUS -->
                                            <span class="inline-flex items-center gap-1 text-xs px-3 py-1 rounded-full font-semibold {{ $order->status === 'pending'
                        ? 'bg-orange-100 text-orange-600'
                        : ($order->status === 'completed'
                            ? 'bg-green-100 text-green-600'
                            : 'bg-gray-100 text-gray-600') }}">

                                                <i class="fa-solid fa-clock"></i>
                                                {{ $order->status }}
                                            </span>

                                        </div>

                                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-xl p-3 text-xs">
                                            <p class="font-semibold text-gray-700 dark:text-gray-300 mb-1">
                                                <i class="fa-solid fa-location-dot mr-1"></i>
                                                Delivery Address
                                            </p>
                                            <p class="text-gray-500 dark:text-gray-400 line-clamp-2">
                                                {{ $order->address['line1'] ?? '' }},
                                                {{ $order->address['city'] ?? '' }},
                                                {{ $order->address['state'] ?? '' }} - {{ $order->address['pincode'] ?? '' }}
                                            </p>
                                        </div>

                                        <div class="space-y-2">
                                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide">
                                                Items ({{ $order->items->count() }})
                                            </p>

                                            <div class="space-y-1">
                                                @foreach ($order->items->take(3) as $item)
                                                    <div class="flex justify-between text-sm">
                                                        <p class="text-gray-700 dark:text-gray-300 line-clamp-1">
                                                            <span class="text-gray-500 font-semibold">{{ $item->quantity }} x </span>
                                                            {{ $item->product->name }}
                                                        </p>
                                                    </div>
                                                @endforeach

                                                @if($order->items->count() > 3)
                                                    <p class="text-xs text-gray-400">
                                                        +{{ $order->items->count() - 3 }} more items
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- FOOTER -->
                                        <div class="flex items-center justify-between pt-3 border-t dark:border-gray-700">
                                            <p class="font-bold text-lg text-gray-900 dark:text-white">
                                                ₹{{ number_format($order->total_amount) }}
                                            </p>

                                            <a wire:navigate href="{{ route('orderview', $order->order_number) }}"
                                                class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:underline">
                                                View Details
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
</div>