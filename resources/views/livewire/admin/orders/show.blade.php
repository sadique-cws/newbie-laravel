<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                        &larr; Back
                    </a>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Order #{{ $this->order->order_number }}
                    </h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ match ($order->status->value) {
    'pending' => 'bg-yellow-100 text-yellow-800',
    'confirmed' => 'bg-blue-100 text-blue-800',
    'shipped' => 'bg-indigo-100 text-indigo-800',
    'delivered' => 'bg-green-100 text-green-800',
    'cancelled' => 'bg-red-100 text-red-800',
    default => 'bg-gray-100 text-gray-800'
} }}">
                        {{ ucfirst($order->status->value) }}
                    </span>
                </div>
                <div class="text-sm text-gray-500">
                    Placed on {{ $order->created_at->format('F d, Y h:i A') }}
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Order Details -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Items -->
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                        <div class="p-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Order Items</h3>
                            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach($order->items as $item)
                                    <div class="py-4 flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div
                                                class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center text-xl">
                                                @if($item->variant->product->category->value == 'MILK') 🥛
                                                @elseif($item->variant->product->category->value == 'WATER') 💧
                                                @else 🍹
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-medium text-gray-900 dark:text-white">
                                                    {{ $item->variant->product->name }}</h4>
                                                <p class="text-sm text-gray-500">{{ $item->variant->unit_size }} x
                                                    {{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-bold text-gray-900 dark:text-white">
                                                ₹{{ number_format($item->price * $item->quantity) }}</p>
                                            <p class="text-xs text-gray-400">₹{{ number_format($item->price) }} each</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700 space-y-2">
                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                    <span>Subtotal</span>
                                    <span>₹{{ number_format($order->subtotal) }}</span>
                                </div>
                                <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                    <span>Delivery Charge</span>
                                    <span>₹{{ number_format($order->delivery_charge) }}</span>
                                </div>
                                <div class="flex justify-between text-lg font-bold text-gray-900 dark:text-white pt-2">
                                    <span>Total</span>
                                    <span>₹{{ number_format($order->grand_total) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Details -->
                <div class="space-y-6">
                    <!-- Actions -->
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-sm font-medium text-gray-500 uppercase mb-4">Order Actions</h3>

                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                                <select wire:model="status" wire:change="updateStatus"
                                    class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    @foreach($statuses as $statusOption)
                                        <option value="{{ $statusOption->value }}">{{ ucfirst($statusOption->value) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Payment
                                    Status</label>
                                <select wire:model="paymentStatus" wire:change="updatePaymentStatus"
                                    class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="pending">Pending</option>
                                    <option value="paid">Paid</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Customer & Address -->
                    <div
                        class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-sm font-medium text-gray-500 uppercase mb-4">Customer Details</h3>

                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold">
                                {{ substr($order->user->name ?? 'G', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $order->user->name ?? 'Guest User' }}</p>
                                <p class="text-xs text-gray-500">{{ $order->user->email ?? 'No email' }}</p>
                            </div>
                        </div>

                        <div class="border-t border-gray-100 dark:border-gray-700 pt-4">
                            <h4 class="text-xs font-semibold text-gray-500 uppercase mb-2">Delivery Address</h4>
                            @if($order->address)
                                <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                    {{ $order->address['line1'] }}<br>
                                    @if($order->address['line2']) {{ $order->address['line2'] }}<br> @endif
                                    {{ $order->address['city'] }}, {{ $order->address['state'] }}
                                    {{ $order->address['pincode'] }}<br>
                                    Phone: {{ $order->address['phone'] }}
                                </p>
                            @else
                                <p class="text-sm text-gray-500 italic">No address details available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>