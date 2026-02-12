<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                Customers
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Manage all registered users
            </p>
        </div>
    </div>

    <!-- FILTERS -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl border p-4 grid grid-cols-1 md:grid-cols-4 gap-4">
        <input wire:model.debounce.300ms="search"
               placeholder="Search name / email / phone"
               class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">

        <select wire:model="role" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
            <option value="">All Roles</option>
            <option value="USER">User</option>
            <option value="RETAILER">Retailer</option>
        </select>

        <select wire:model="status" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
            <option value="">All KYC Status</option>
            <option value="SUBMITTED">Submitted</option>
            <option value="PENDING">Pending</option>
            <option value="VERIFIED">Verified</option>
            <option value="REJECTED">Rejected</option>
        </select>

        <select wire:model="active" class="rounded-xl border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
            <option value="">Active / Inactive</option>
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
    </div>

    <!-- TABLE -->
    <div class="bg-white dark:bg-gray-800 border rounded-2xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50 dark:bg-gray-900/40">
                <tr>
                    <th class="px-6 py-4 text-left">User</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">KYC Status</th>
                    <th class="px-6 py-4">Active</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y dark:divide-gray-700">
                @forelse($customers as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/40">

                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-900 dark:text-white">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                {{ $user->role === 'RETAILER' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-600' }}">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full
                                @if($user->apply_status === 'VERIFIED') bg-green-100 text-green-700
                                @elseif($user->apply_status === 'REJECTED') bg-red-100 text-red-700
                                @elseif($user->apply_status) bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-500 @endif">
                                {{ $user->apply_status ?? 'N/A' }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="text-xs font-semibold {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <button wire:click="view({{ $user->id }})"
                                    class="text-blue-600 font-semibold hover:underline">
                                View
                            </button>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-500">
                            No customers found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4 border-t dark:border-gray-700">
            {{ $customers->links() }}
        </div>
    </div>

    <!-- ================= MODAL ================= -->
    @if($showModal && $selectedUser)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 px-4">
            <div class="bg-white dark:bg-gray-800 w-full max-w-2xl rounded-2xl border max-h-screen overflow-y-auto">

                <div class="px-6 py-4 border-b font-bold text-lg">
                    Customer Details
                </div>

                <div class="p-6 space-y-4 text-sm">

                    <p><strong>Name:</strong> {{ $selectedUser->name }}</p>
                    <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
                    <p><strong>Phone:</strong> {{ $selectedUser->phone ?? '-' }}</p>
                    <p><strong>Role:</strong> {{ $selectedUser->role }}</p>
                    <p><strong>Last Login:</strong> {{ $selectedUser->last_login_at ?? 'Never' }}</p>

                    <hr>

                    <p><strong>KYC Status:</strong> {{ $selectedUser->apply_status ?? 'N/A' }}</p>

                    @if($selectedUser->rejection_reason)
                        <p class="text-red-600">
                            <strong>Rejection Reason:</strong> {{ $selectedUser->rejection_reason }}
                        </p>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        @if($selectedUser->aadhar_card_front)
                            <img src="{{ asset('storage/'.$selectedUser->aadhar_card_front) }}" class="rounded-xl border">
                        @endif
                        @if($selectedUser->aadhar_card_back)
                            <img src="{{ asset('storage/'.$selectedUser->aadhar_card_back) }}" class="rounded-xl border">
                        @endif
                    </div>

                </div>

                <div class="px-6 py-4 border-t text-right">
                    <button wire:click="closeModal"
                            class="px-4 py-2 rounded-xl bg-gray-200 dark:bg-gray-700">
                        Close
                    </button>
                </div>

            </div>
        </div>
    @endif

</div>
