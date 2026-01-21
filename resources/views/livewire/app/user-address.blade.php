<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex gap-6">

        {{-- SIDEBAR --}}
        @include('components.app.user-sidebar')

        {{-- MAIN --}}
        <main class="flex-1 space-y-6">

            {{-- PAGE HEADER --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                        My Addresses
                    </h1>
                    <p class="text-sm text-gray-500">
                        Add your delivery address so orders reach you easily
                    </p>
                </div>

                <button wire:click="openAdd" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                           bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-semibold">
                    <i class="fa-solid fa-plus"></i>
                    Add Address
                </button>
            </div>

            {{-- EMPTY STATE --}}
            @if($addresses->isEmpty())
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-10 text-center">
                    <i class="fa-solid fa-location-dot text-4xl text-gray-300 mb-4"></i>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                        No address added yet
                    </h2>
                    <p class="text-sm text-gray-500 mt-1">
                        Add your home or office address to continue
                    </p>

                    <button wire:click="openAdd"
                        class="mt-4 px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                        Add your first address
                    </button>
                </div>
            @else
                {{-- ADDRESS LIST --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4">

                    @foreach($addresses as $address)
                        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-4 space-y-3">

                            <div class="flex justify-between items-start">
                                <p class="font-semibold text-gray-900 dark:text-white">
                                    {{ $address->label }}
                                </p>

                                @if($address->is_default)
                                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600 font-semibold">
                                        Default
                                    </span>
                                @endif
                            </div>

                            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                                {{ $address->line1 }}<br>
                                {{ $address->city }}, {{ $address->state }} – {{ $address->pincode }}
                            </p>

                            <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">
                                <i class="fa-solid fa-phone mr-1"></i>
                                {{ $address->phone }}
                            </p>

                            <div class="flex gap-4 text-sm font-semibold">
                                <button wire:click="openEdit({{ $address->id }})" class="text-blue-600 hover:underline">
                                    <i class="fa-solid fa-pen mr-1"></i> Edit
                                </button>
                                <button wire:click="delete({{ $address->id }})" class="text-red-500 hover:underline">
                                    <i class="fa-solid fa-trash mr-1"></i> Delete
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>
            @endif
        </main>
    </div>

    {{-- ================= MODAL ================= --}}
    @if($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">

            <div class="bg-white dark:bg-gray-900 rounded-2xl w-full max-w-lg p-6">

                <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    {{ $editing ? 'Edit Address' : 'Add New Address' }}
                </h2>

                <div class="space-y-3">

                    {{-- INPUT STYLE NOTE:
                    text-gray-900 -> typed text
                    placeholder:text-gray-400 -> placeholder
                    --}}

                    <input wire:model="label" placeholder="Label (Home / Office)"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <input wire:model="line1" placeholder="Address line"
                        class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <div class="grid grid-cols-2 gap-3">
                        <input wire:model="city" placeholder="City"
                            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500">

                        <input wire:model="state" placeholder="State"
                            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <input wire:model="pincode" placeholder="Pincode"
                            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500">

                        <input wire:model="phone" placeholder="Phone number"
                            class="w-full rounded-xl border border-gray-300 dark:border-gray-700 px-4 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder:text-gray-400 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
                        <input type="checkbox" wire:model="is_default">
                        Make this default address
                    </label>

                    <div class="flex justify-end gap-3 pt-4">
                        <button wire:click="closeModal" class="px-4 py-2 text-sm text-gray-600 dark:text-gray-300">
                            Cancel
                        </button>
                        <button wire:click="save"
                            class="px-5 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold">
                            Save Address
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>