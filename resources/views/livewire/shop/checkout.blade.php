<div class="min-h-screen bg-gray-50 dark:bg-black/40 py-8">
    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT SECTION -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Delivery Address -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Delivery Address</h2>


                </div>

                <div class="space-y-3">

                    <!-- Address List -->
                    @unless($showAddressForm)
                        @forelse($addresses as $address)
                                        <div class="group flex items-start justify-between gap-4 p-5 rounded-xl border transition
                            {{ $selectedAddress == $address->id
                                ? 'border-[#A855F7] bg-purple-50 dark:bg-purple-900/20 shadow-sm'
                                : 'border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900
                                   hover:border-purple-300 dark:hover:border-purple-700
                                   hover:bg-purple-50/40 dark:hover:bg-purple-900/10' }}">

                                            <!-- LEFT -->
                                            <label class="flex gap-4 cursor-pointer flex-1">
                                                <input type="radio" wire:model.live="selectedAddress" value="{{ $address->id }}"
                                                    class="mt-1 accent-[#A855F7]">

                                                <div class="text-sm leading-relaxed">
                                                    <p class="font-extrabold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                                                        {{ auth()->user()->name }}

                                                        <!-- Home / Office badge -->
                                                        <span class="text-[10px] uppercase font-bold tracking-wide px-2 py-0.5 rounded
                                            {{ $address->label === 'Home'
                                ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300'
                                : 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-300' }}">
                                                            {{ $address->label }}
                                                        </span>
                                                    </p>

                                                    <p class="text-gray-600 dark:text-gray-400 mt-1">
                                                        {{ $address->line1 }}
                                                        @if($address->line2)
                                                            , {{ $address->line2 }}
                                                        @endif
                                                    </p>

                                                    <p class="text-gray-600 dark:text-gray-400">
                                                        {{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}
                                                    </p>

                                                    <p class="mt-2 text-xs font-bold text-gray-500 dark:text-gray-400">
                                                        📞 {{ $address->phone }}
                                                    </p>
                                                </div>
                                            </label>

                                            <!-- RIGHT -->
                                            <button wire:click="editAddress({{ $address->id }})" class="text-xs font-extrabold text-[#A855F7]
                                       opacity-70 group-hover:opacity-100 transition">
                                                Edit
                                            </button>
                                        </div>
                        @empty
                            <div class="text-center py-10">
                                <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                                    No saved address found
                                </p>
                                <button wire:click="addNewAddress"
                                    class="inline-flex items-center gap-2 text-sm font-bold text-[#A855F7] hover:underline">
                                    + Add New Address
                                </button>
                            </div>
                        @endforelse



                        <button wire:click="addNewAddress" class="text-sm font-bold text-purple-600">
                            + Add New Address
                        </button>
                    @endunless

                    <!-- Add / Edit Form -->
                    @if($showAddressForm)
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">

                            <!-- Address Type -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    Address Type
                                </label>
                                <select wire:model.defer="label" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                    <option value="">Select</option>
                                    <option value="Home">Home</option>
                                    <option value="Office">Office</option>
                                </select>
                                @error('label')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    Phone Number
                                </label>
                                <input wire:model.defer="phone" type="tel" placeholder="10 digit mobile number" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Line 1 -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    Address Line 1
                                </label>
                                <input wire:model.defer="line1" type="text" placeholder="House no, Building, Street" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('line1')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address Line 2 -->
                            <div class="md:col-span-2">
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    Address Line 2 (Optional)
                                </label>
                                <input wire:model.defer="line2" type="text" placeholder="Landmark, Area" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('line2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    City
                                </label>
                                <input wire:model.defer="city" type="text" placeholder="City" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('city')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- State -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    State
                                </label>
                                <input wire:model.defer="state" type="text" placeholder="State" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('state')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pincode -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">
                                    Pincode
                                </label>
                                <input wire:model.defer="pincode" type="text" placeholder="6 digit pincode" class="w-full rounded-lg px-3 py-2 text-sm outline-none
                               border border-gray-300 dark:border-gray-700
                               bg-white dark:bg-gray-800
                               text-gray-900 dark:text-gray-100
                               placeholder-gray-400 dark:placeholder-gray-500
                               focus:border-[#A855F7] focus:ring-2 focus:ring-purple-200 dark:focus:ring-purple-900">
                                @error('pincode')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ACTIONS -->
                            <div class="md:col-span-2 flex gap-3 pt-2">
                                <button wire:click="saveAddress" class="flex-1 bg-[#A855F7] hover:bg-[#9333EA]
                               text-white py-2.5 rounded-lg font-bold
                               transition active:scale-[0.98] shadow">
                                    {{ $editingAddressId ? 'Update Address' : 'Save Address' }}
                                </button>

                                <button wire:click="resetAddressForm" class="flex-1 border border-gray-300 dark:border-gray-700
                               py-2.5 rounded-lg font-bold
                               hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                                    Cancel
                                </button>
                            </div>

                        </div>
                    @endif

                </div>


                <!-- Add Address Form -->

            </div>


            <!-- Cart Items -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold mb-4">Order Items</h2>

                <ul class="divide-y">
                    @foreach($cart as $item)
                        <li class="flex gap-4 py-4">
                            <img src="{{ $item['image_url'] }}" class="w-16 h-16 rounded-lg object-cover border">

                            <div class="flex-1">
                                <p class="font-bold text-sm">{{ explode(' - ', $item['name'])[0] }}</p>
                                <p class="text-xs text-gray-500">{{ $item['unit_size'] }}</p>
                                <p class="font-bold mt-1">₹{{ number_format($item['price']) }}</p>
                            </div>

                            <div class="text-sm font-bold">
                                × {{ $item['quantity'] }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Payment -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold mb-4">Payment Method</h2>

                <label class="flex items-center gap-3 p-4 border rounded-lg cursor-pointer">
                    <input type="radio" checked class="accent-purple-600">
                    <span class="font-bold text-sm">Cash on Delivery (Dummy)</span>
                </label>
            </div>
        </div>

        <!-- RIGHT SUMMARY -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm p-6 h-fit sticky top-6">
            <h2 class="text-lg font-bold mb-4">Price Details</h2>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between text-gray-500">
                    <span>Items Total</span>
                    <span>₹{{ number_format($itemsTotal) }}</span>
                </div>

                <div class="flex justify-between text-gray-500">
                    <span>Delivery</span>
                    <span>₹{{ $deliveryCharge }}</span>
                </div>

                <div class="border-t pt-3 flex justify-between text-base font-extrabold">
                    <span>Total</span>
                    <span>₹{{ number_format($grandTotal) }}</span>
                </div>
            </div>
            @if ($selectedAddress)
                <button wire:click="placeOrder"
                    class="w-full mt-6 bg-[#A855F7] hover:bg-[#9333EA] text-white py-3 rounded-xl font-bold transition">
                    Place Order
                </button>
            @else
                <button disabled
                    class="w-full mt-6 bg-[#312041] hover:bg-[#3c2f47] cursor-not-allowed text-white py-3 rounded-xl font-bold transition">
                    Place Order
                </button>
            @endif
        </div>

    </div>
</div>