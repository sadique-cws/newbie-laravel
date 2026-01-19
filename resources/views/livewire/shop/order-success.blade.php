<div class="min-h-screen bg-gray-50 dark:bg-black/40 flex items-center justify-center px-4">
    <div class="w-full max-w-lg bg-white dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">

        <!-- Top Accent -->
        <div class="h-2 bg-gradient-to-r from-[#A855F7] to-[#9333EA]"></div>

        <div class="p-8 text-center">

            <!-- Icon -->
            <div
                class="w-20 h-20 mx-auto rounded-full bg-purple-100 dark:bg-purple-900/30
                       flex items-center justify-center mb-6">
                <svg class="w-10 h-10 text-[#A855F7]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <!-- Title -->
            <h1 class="text-2xl font-extrabold text-gray-900 dark:text-white mb-2">
                Order Confirmed 🎉
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                Your order has been placed successfully.
                We’ll start processing it right away.
            </p>

            <!-- Order ID Card -->
            <div
                class="bg-gray-50 dark:bg-gray-800 border border-dashed border-gray-300 dark:border-gray-700
                       rounded-xl p-4 mb-6">
                <p class="text-xs uppercase tracking-widest text-gray-500 font-bold mb-1">
                    Order ID
                </p>
                <p class="text-lg font-extrabold text-[#A855F7]">
                    {{ $orderId }}
                </p>
            </div>

            <!-- Info -->
            <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1 mb-8">
                <p>📦 Order details have been saved</p>
                <p>🚚 Delivery updates will be shared soon</p>
                <p>💬 You can track your order from your account</p>
            </div>

            <!-- Actions -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href=""
                    class="flex-1 bg-[#A855F7] hover:bg-[#9333EA]
                           text-white py-3 rounded-xl font-bold transition
                           shadow active:scale-[0.98]">
                    Continue Shopping
                </a>

                <a href=""
                    class="flex-1 border border-gray-300 dark:border-gray-700
                           py-3 rounded-xl font-bold
                           hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                    View My Orders
                </a>
            </div>
        </div>
    </div>
</div>
