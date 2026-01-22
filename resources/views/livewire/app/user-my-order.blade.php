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

                @foreach ($orders as $order)
                            @php
                                $address = json_decode($order->shipping_address, true);
                            @endphp

                            <div
                                class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-5 space-y-4 shadow-sm hover:shadow-md transition">

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
                                                   <span class="text-gray-500 font-semibold">{{ $item->quantity }} x </span> {{ $item->product->name }}
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

                                    <a href=""
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