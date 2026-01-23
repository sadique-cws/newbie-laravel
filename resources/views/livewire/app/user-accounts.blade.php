<div class="max-w-md mx-auto px-4 py-6 space-y-6 lg:hidden">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
            Account
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Manage your account & activities
        </p>
    </div>

    <!-- ACCOUNT MENU -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm divide-y dark:divide-gray-700">

        <!-- Dashboard -->
        <a wire:navigate href="{{ route('dashboard') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                <i class="fa-solid fa-chart-line text-blue-600 dark:text-blue-400"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                Dashboard
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

        <!-- Orders -->
        <a wire:navigate href="{{ route('myorders') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                <i class="fa-solid fa-bag-shopping text-indigo-600 dark:text-indigo-400"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                My Orders
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

        <!-- Wishlist -->
        <a wire:navigate href="{{ route('wishlist') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-pink-100 dark:bg-pink-900/40 flex items-center justify-center">
                <i class="fa-solid fa-heart text-pink-500"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                Wishlist
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

        <!-- Addresses -->
        <a wire:navigate href="{{ route('myaddresses') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center">
                <i class="fa-solid fa-location-dot text-blue-600 dark:text-blue-400"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                Addresses
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

        <!-- KYC -->
        <a wire:navigate href="{{ route('applytoretailer') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center">
                <i class="fa-solid fa-id-card text-amber-600 dark:text-amber-400"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                KYC Documents
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

        <!-- Profile -->
        <a wire:navigate href="{{ route('profile') }}"
            class="flex items-center gap-4 px-4 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
            <span class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/40 flex items-center justify-center">
                <i class="fa-solid fa-user text-emerald-600 dark:text-emerald-400"></i>
            </span>
            <span class="flex-1 font-semibold text-gray-800 dark:text-gray-200">
                Profile
            </span>
            <i class="fa-solid fa-chevron-right text-gray-400"></i>
        </a>

    </div>

    <!-- LOGOUT -->
    <form method="POST" action="{{ route('logout') }}" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm">
        @csrf
        <button type="submit" class="w-full flex items-center gap-4 px-4 py-4 text-red-600 font-semibold
                   hover:bg-red-50 dark:hover:bg-red-900/30 transition">
            <span class="w-10 h-10 rounded-xl bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </span>
            Logout
        </button>
    </form>

</div>