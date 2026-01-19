<div>
    <div x-data="{ open: @entangle('isOpen') }" @keydown.window.escape="open = false" x-show="open"
        class="relative z-50" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" style="display: none;">

        <div x-show="open" x-transition:enter="ease-in-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/60 transition-opacity backdrop-blur-[2px]"></div>

        <div class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-0 sm:pl-10">
                    <div x-show="open"
                        x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                        x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                        x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                        class="pointer-events-auto w-screen sm:max-w-md">

                        <div class="flex h-full flex-col bg-white dark:bg-gray-900 shadow-2xl font-sans">
                            <!-- Header -->
                            <div
                                class="flex items-center justify-between px-6 py-5 border-b border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 relative z-10">
                                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100" id="slide-over-title">My
                                    Cart</h2>
                                <button type="button" @click="open = false"
                                    class="relative rounded-md text-gray-400 hover:text-gray-500 text-2xl leading-none p-2 -mr-2">
                                    &times;
                                </button>
                            </div>

                            <!-- Scrollable Content -->
                            <div class="flex-1 overflow-y-auto bg-gray-50/50 dark:bg-black/20">
                                <!-- Items List -->
                                <div class="px-4 py-4 bg-white dark:bg-gray-900 mb-2 shadow-sm">
                                    <ul role="list" class="divide-y divide-gray-100 dark:divide-gray-800">
                                        @forelse($cart as $id => $item)
                                            <li class="flex py-4">
                                                <!-- Image -->
                                                <div
                                                    class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg border border-gray-100 dark:border-gray-800 bg-gray-50 dark:bg-gray-800">
                                                    @if($item['image_url'])
                                                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}"
                                                            class="h-full w-full object-cover object-center">
                                                    @else
                                                        <div class="flex items-center justify-center h-full text-2xl">📦</div>
                                                    @endif
                                                </div>

                                                <div class="ml-4 flex flex-1 flex-col justify-between">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <h3
                                                                class="font-bold text-gray-900 dark:text-gray-100 text-sm mb-1 leading-snug">
                                                                {{ explode(' - ', $item['name'])[0] }}
                                                            </h3>
                                                            <span
                                                                class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 uppercase tracking-wide border border-gray-200 dark:border-gray-700">
                                                                {{ $item['unit_size'] }}
                                                            </span>
                                                            <div
                                                                class="mt-2 text-sm font-bold text-gray-900 dark:text-gray-100">
                                                                ₹{{ number_format($item['price']) }}
                                                            </div>
                                                        </div>

                                                        <!-- Quantity Stepper -->
                                                        <div class="flex items-center self-end">
                                                            <div
                                                                class="flex items-center bg-[#A855F7] rounded-md overflow-hidden h-8 shadow-sm">
                                                                <button wire:click="updateQuantity('{{ $id }}', -1)"
                                                                    class="w-8 h-full flex items-center justify-center text-white hover:bg-[#9333EA] transition font-medium text-lg leading-none pb-1">-</button>
                                                                <span
                                                                    class="w-8 h-full flex items-center justify-center text-white font-bold text-sm bg-white/10">{{ $item['quantity'] }}</span>
                                                                <button wire:click="updateQuantity('{{ $id }}', 1)"
                                                                    class="w-8 h-full flex items-center justify-center text-white hover:bg-[#9333EA] transition font-medium text-lg leading-none pb-1">+</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @empty
                                            <div class="py-12 text-center flex flex-col items-center justify-center">
                                                <div
                                                    class="w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center text-3xl mb-4">
                                                    🛒</div>
                                                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Your cart
                                                    is empty</h3>
                                                <p class="text-gray-500 text-sm max-w-xs mx-auto">Add items to your cart to
                                                    see them here.</p>
                                                <button @click="open = false"
                                                    class="mt-6 px-6 py-2 bg-[#A855F7] text-white rounded-full font-bold text-sm shadow hover:bg-[#9333EA] transition">Start
                                                    Shopping</button>
                                            </div>
                                        @endforelse
                                    </ul>
                                </div>

                                @if(count($cart) > 0)
                                    <!-- Bill Details -->
                                    <div class="px-6 py-5 bg-white dark:bg-gray-900 mb-2 shadow-sm">
                                        <h3 class="font-bold text-gray-900 dark:text-white mb-4 text-sm">Bill details</h3>
                                        <div class="space-y-3 text-sm">
                                            <div class="flex justify-between text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 7h6m0 4h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Items total
                                                </div>
                                                <span class="font-medium">₹{{ number_format($itemsTotal) }}</span>
                                            </div>
                                            <div class="flex justify-between text-gray-500 dark:text-gray-400">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Delivery charge
                                                </div>
                                                <span class="font-medium">₹{{ number_format($deliveryCharge) }}</span>
                                            </div>
                                            <div
                                                class="pt-3 flex justify-between text-base font-extrabold text-gray-900 dark:text-white border-t border-gray-100 dark:border-gray-800 mt-2">
                                                <span>Grand total</span>
                                                <span>₹{{ number_format($grandTotal) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Cancellation Policy -->
                                    <div class="px-6 py-5 bg-white dark:bg-gray-900 shadow-sm">
                                        <h3 class="font-bold text-gray-900 dark:text-white mb-2 text-sm">Cancellation Policy
                                        </h3>
                                        <p
                                            class="text-[11px] text-gray-500 leading-relaxed dark:text-gray-400 bg-gray-50 dark:bg-gray-800 p-3 rounded-lg border border-gray-100 dark:border-gray-800">
                                            Orders cannot be cancelled once packed for delivery. In case of unexpected
                                            delays, a refund will be provided, if applicable.
                                        </p>
                                    </div>
                                    <div class="h-28"></div> <!-- Spacer for footer -->
                                @endif
                            </div>

                            @if(count($cart) > 0)
                                <!-- Footer Action -->
                                <div
                                    class="absolute bottom-0 w-full border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 px-4 py-4 z-20 shadow-[0_-5px_20px_-5px_rgba(0,0,0,0.1)]">
                                    <button
                                        class="w-full flex items-center justify-between rounded-xl bg-[#A855F7] px-4 py-3 shadow-lg shadow-purple-200 dark:shadow-none hover:bg-[#9333EA] transition active:scale-[0.99] group">
                                        <div class="flex flex-col items-start text-white pl-2">
                                            <span
                                                class="font-bold text-lg leading-none">₹{{ number_format($grandTotal) }}</span>
                                            <span
                                                class="text-[10px] uppercase font-bold text-white/80 tracking-wide mt-0.5">Total</span>
                                        </div>
                                        @auth
                                            <a wire:navigate href="{{ route('checkout') }}"
                                                class="flex items-center font-bold text-white text-sm pr-2">
                                                Proceed
                                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        @else
                                            <a wire:navigate href="{{ route('login') }}"
                                                class="flex items-center font-bold text-white text-sm pr-2">
                                                Login to Proceed
                                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                                </svg>
                                            </a>
                                        @endauth

                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>