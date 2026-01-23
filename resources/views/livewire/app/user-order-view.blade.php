<div class="min-h-screen  dark:bg-gray-900 py-8 px-4">
    <div class="max-w-6xl mx-auto space-y-8">

        <!-- ORDER HEADER CARD -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl p-6 border dark:border-gray-700 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white">
                    Order #{{ $order->order_number }}
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Placed on {{ $order->created_at->format('d M Y, h:i A') }}
                </p>
            </div>

            <span class="inline-flex items-center gap-2 text-sm px-4 py-2 rounded-full font-bold
                {{
    match ($order->status) {
        'pending' => 'bg-orange-100 text-orange-600',
        'completed' => 'bg-green-100 text-green-600',
        'cancelled' => 'bg-red-100 text-red-600',
        default => 'bg-gray-100 text-gray-600',
    }
                }}">
                <i class="fa-solid fa-circle-dot text-xs"></i>
                {{ $order->status }}
            </span>
        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            <!-- LEFT CONTENT -->
            <div class="lg:col-span-3 space-y-6">

                <!-- ORDER ITEMS -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border dark:border-gray-700">
                    <h2 class="font-bold text-lg mb-5 text-gray-900 dark:text-white">
                        Ordered Items
                    </h2>

                    <div class="divide-y dark:divide-gray-700">
                        @foreach ($order->items as $item)
                            <div class="flex items-start gap-4 py-4">
                                <!-- IMAGE -->
                                <div
                                    class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-xl flex items-center justify-center text-gray-400">
                                    <i class="fa-solid fa-box"></i>
                                </div>

                                <!-- INFO -->
                                <div class="flex-1">
                                    <p class="font-semibold text-gray-800 dark:text-gray-200">
                                        {{ $item->product_name }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $item->variant_name }}
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Qty: {{ $item->quantity }}
                                    </p>
                                </div>

                                <!-- PRICE -->
                                <div class="text-right">
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        ₹{{ number_format($item->total) }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        ₹{{ number_format($item->price) }} / unit
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- ADDRESS -->
                @if(!empty($order->address))
                    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border dark:border-gray-700">
                        <h2 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">
                            Delivery Address
                        </h2>

                        <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed space-y-1">
                            <p>{{ $order->address['line1'] ?? '' }}</p>
                            <p>
                                {{ $order->address['city'] ?? '' }},
                                {{ $order->address['state'] ?? '' }} -
                                {{ $order->address['pincode'] ?? '' }}
                            </p>
                            <p>{{ $order->address['country'] ?? '' }}</p>

                            @if(!empty($order->address['phone']))
                                <p class="mt-2 font-semibold">
                                    📞 {{ $order->address['phone'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- RIGHT SIDEBAR -->
            <div class="space-y-6 lg:sticky lg:top-20 h-fit">

                <!-- PRICE SUMMARY -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border dark:border-gray-700">
                    <h2 class="font-bold text-lg mb-4 text-gray-900 dark:text-white">
                        Price Summary
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span>₹{{ number_format($order->subtotal) }}</span>
                        </div>

                        <div class="flex justify-between">
                            <span>Delivery Fee</span>
                            <span>₹{{ number_format($order->delivery_fee) }}</span>
                        </div>

                        @if($order->discount > 0)
                            <div class="flex justify-between text-green-600">
                                <span>Discount</span>
                                <span>- ₹{{ number_format($order->discount) }}</span>
                            </div>
                        @endif

                        <hr class="dark:border-gray-700">

                        <div class="flex justify-between text-lg font-extrabold">
                            <span>Total</span>
                            <span>₹{{ number_format($order->total_amount) }}</span>
                        </div>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="flex flex-col gap-3">
                    <a wire:navigate href="{{ route('myorders') }}"
                        class="w-full text-center px-4 py-2 rounded-xl border font-semibold hover:bg-gray-100 dark:hover:bg-gray-700">
                        ← Back to Orders
                    </a>

                    <button class="w-full px-4 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700">
                        Download Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>