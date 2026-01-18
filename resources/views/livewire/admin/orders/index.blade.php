<div class="py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Orders Management</h1>
            <p class="text-sm text-gray-500 mt-1">View and manage all customer orders</p>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 mb-6">
        <div class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text" placeholder="Search Order ID, Customer, Product..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border-gray-200 dark:bg-gray-700 dark:border-gray-600 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500">
                    <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex gap-4">
                <select class="bg-gray-50 border-gray-200 dark:bg-gray-700 dark:border-gray-600 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500 py-2 pl-3 pr-10">
                    <option>Status</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Delivered</option>
                    <option>Cancelled</option>
                </select>
                <select class="bg-gray-50 border-gray-200 dark:bg-gray-700 dark:border-gray-600 rounded-lg text-sm focus:ring-purple-500 focus:border-purple-500 py-2 pl-3 pr-10">
                    <option>Date Range</option>
                    <option>Today</option>
                    <option>Yesterday</option>
                    <option>This Week</option>
                    <option>This Month</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700">
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Order Details</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Items</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Status & Address</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($orders as $order)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/25 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-900 dark:text-white">#{{ $order->order_number }}</span>
                                <span class="text-xs text-gray-500 mt-0.5">{{ $order->created_at->format('d M Y, h:i A') }}</span>
                                <div class="mt-2 flex items-center">
                                    <div class="h-6 w-6 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-xs font-bold mr-2">
                                        {{ substr($order->user->name ?? 'G', 0, 1) }}
                                    </div>
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $order->user->name ?? 'Guest' }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->user->mobile ?? 'No Mobile' }}</p>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-2">
                                @foreach($order->items->take(2) as $item)
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded bg-gray-100 flex-shrink-0">
                                        <!-- Placeholder for product image -->
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->variant->product->name ?? 'Product' }}</p>
                                        <p class="text-xs text-gray-500">{{ $item->variant->unit_size ?? '' }}</p>
                                    </div>
                                </div>
                                @endforeach
                                @if($order->items->count() > 2)
                                <p class="text-xs text-gray-500 pl-11">+{{ $order->items->count() - 2 }} more items</p>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-2">
                                <span class="inline-flex self-start items-center px-2.5 py-0.5 rounded-md text-xs font-bold uppercase tracking-wide
                                    {{ match($order->status->value) {
                                        'pending' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                        'confirmed' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                        'shipped' => 'bg-purple-100 text-purple-700 border border-purple-200',
                                        'delivered' => 'bg-green-100 text-green-700 border border-green-200',
                                        'cancelled' => 'bg-red-50 text-red-600 border border-red-100',
                                        default => 'bg-gray-100 text-gray-600'
                                    } }}">
                                    {{ $order->status->value }}
                                </span>
                                <div class="text-xs text-gray-500 max-w-[180px]">
                                    <p class="font-medium text-gray-900 dark:text-gray-200">Delivery Address:</p>
                                    <p>{{ Str::limit($order->address->address_line_1 ?? 'N/A', 40) }}</p>
                                    <p>{{ $order->address->city ?? '' }}, {{ $order->address->pincode ?? '' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-right sm:text-left">
                                <span class="text-lg font-bold text-purple-600">₹{{ number_format($order->grand_total) }}</span>
                                <p class="text-xs text-gray-500">{{ $order->items->sum('quantity') }} Items</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex flex-col gap-2 items-end">
                                <a href="{{ route('admin.orders.show', $order) }}" wire:navigate class="inline-flex items-center justify-center px-4 py-1.5 bg-blue-600 text-white text-xs font-bold rounded-lg hover:bg-blue-700 transition shadow-sm shadow-blue-200 dark:shadow-none w-28">
                                    View Order
                                </a>
                                @if($order->status->value === 'pending')
                                <button class="inline-flex items-center justify-center px-4 py-1.5 bg-white border border-gray-200 text-red-600 text-xs font-bold rounded-lg hover:bg-red-50 transition w-28">
                                    Cancel
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                                </svg>
                                <p class="text-base font-medium text-gray-900 dark:text-gray-100">No orders found</p>
                                <p class="text-sm text-gray-400 mt-1">Check back later or adjust your filters.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>