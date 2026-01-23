<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
            Retailer KYC Requests
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Review and verify retailer applications
        </p>
    </div>

    <!-- REQUEST TABLE -->
    <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-xl overflow-hidden">

        <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700/50 text-gray-700 dark:text-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left">User</th>
                    <th class="px-4 py-3 text-left">Aadhar</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-gray-700">
                @forelse($requests as $user)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="font-semibold text-gray-800 dark:text-gray-100">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </td>

                                <td class="px-4 py-3 font-mono text-gray-700 dark:text-gray-300">
                                    {{ $user->aadhar_card }}
                                </td>

                                <td class="px-4 py-3">
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold {{ $user->apply_status === 'SUBMITTED'
                    ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300'
                    : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300' }}">
                                        {{ $user->apply_status }}
                                    </span>
                                </td>

                                <td class="px-4 py-3 text-right">
                                    <button wire:click="openModal({{ $user->id }})"
                                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-purple-600 text-white hover:bg-purple-700">
                                        Review
                                    </button>
                                </td>
                            </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                            No retailer applications pending
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- REVIEW MODAL -->
    @if($showModal && $selectedUser)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 px-4">

            <!-- MODAL -->
            <div
                class="bg-white dark:bg-gray-800 w-full max-w-2xl rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 flex flex-col max-h-screen p-4">

                <!-- HEADER -->
                <div
                    class="flex items-center justify-between px-5 py-3 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">

                    <h2 class="text-base font-semibold text-gray-800 dark:text-gray-100">
                        Retailer KYC Review
                    </h2>

                    <button wire:click="closeModal"
                        class="text-xl leading-none text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 cursor-pointer">
                        &times;
                    </button>
                </div>

                <!-- BODY (SCROLLABLE) -->
                <div class=" space-y-5 overflow-y-auto p-2">

                    <!-- USER INFO -->
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('storage/' . $selectedUser->avatar_url) }}"
                            class="h-14 w-14 rounded-full object-cover border">

                        <div>
                            <p class="font-semibold text-gray-800 dark:text-gray-100">
                                {{ $selectedUser->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $selectedUser->email }}
                            </p>
                            <p class="text-xs text-gray-500 mt-0.5">
                                Aadhar: {{ $selectedUser->aadhar_card }}
                            </p>
                        </div>
                    </div>

                    <!-- DOCUMENTS -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs font-semibold mb-1 text-gray-600 dark:text-gray-400">
                                Aadhar Front
                            </p>
                            <img src="{{ asset('storage/' . $selectedUser->aadhar_card_front) }}"
                                class="w-full h-40 object-cover rounded-lg border hover:scale-105 transition-transform">
                        </div>

                        <div>
                            <p class="text-xs font-semibold mb-1 text-gray-600 dark:text-gray-400">
                                Aadhar Back
                            </p>
                            <img src="{{ asset('storage/' . $selectedUser->aadhar_card_back) }}"
                                class="w-full h-40 object-cover rounded-lg border hover:scale-105 transition-transform">
                        </div>
                    </div>

                    <!-- REJECT REASON -->
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
                            Rejection Reason (required if rejecting)
                        </label>

                        <textarea wire:model.defer="rejectReason" rows="4"
                            class="w-full rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-purple-500 p-2"
                            placeholder="Write a clear reason for rejection"></textarea>

                        @error('rejectReason')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- FOOTER -->
                <div
                    class="flex justify-end gap-3 px-5 py-3 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">

                    <button wire:click="reject"
                        class="px-4 py-2 rounded-lg text-sm font-semibold border border-red-500 text-red-600 hover:bg-red-50 dark:hover:bg-red-900 cursor-pointer">
                        Reject
                    </button>

                    <button wire:click="approve"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-purple-600 text-white hover:bg-purple-700 cursor-pointer">
                        Verify
                    </button>
                </div>

            </div>
        </div>
    @endif




</div>