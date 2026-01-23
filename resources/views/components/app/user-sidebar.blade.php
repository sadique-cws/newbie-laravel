<aside class="hidden lg:block w-64 shrink-0">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm p-4 sticky top-24 flex flex-col">

        <p class="text-xs uppercase tracking-widest text-gray-400 mb-4 px-2">
            Account
        </p>

        <nav class="space-y-1 text-sm font-medium flex-1">

            <!-- Dashboard -->
            <a wire:navigate href="{{ route('dashboard') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('dashboard') ? 'bg-blue-50 dark:bg-blue-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('dashboard')
    ? 'bg-blue-100 dark:bg-blue-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40' }}">
                    <i class="fa-solid fa-chart-line
                        {{ request()->routeIs('dashboard')
    ? 'text-blue-600 dark:text-blue-400'
    : 'text-gray-500 group-hover:text-blue-600' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('dashboard')
    ? 'font-semibold text-blue-600 dark:text-blue-400'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Dashboard
                </span>
            </a>

            <!-- Orders -->
            <a wire:navigate href="{{ route('myorders') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('myorders*') ? 'bg-indigo-50 dark:bg-indigo-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('myorders*')
    ? 'bg-indigo-100 dark:bg-indigo-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-indigo-100 dark:group-hover:bg-indigo-900/40' }}">
                    <i class="fa-solid fa-bag-shopping
                        {{ request()->routeIs('myorders*')
    ? 'text-indigo-600 dark:text-indigo-400'
    : 'text-gray-500 group-hover:text-indigo-600' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('myorders*')
    ? 'font-semibold text-indigo-600 dark:text-indigo-400'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Orders
                </span>
            </a>

            <!-- Wishlist -->
            <a wire:navigate href="{{ route('wishlist') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('wishlist*') ? 'bg-pink-50 dark:bg-pink-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('wishlist*')
    ? 'bg-pink-100 dark:bg-pink-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-pink-100 dark:group-hover:bg-pink-900/40' }}">
                    <i class="fa-solid fa-heart
                        {{ request()->routeIs('wishlist*')
    ? 'text-pink-500'
    : 'text-gray-500 group-hover:text-pink-500' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('wishlist*')
    ? 'font-semibold text-pink-500'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Wishlist
                </span>
            </a>

            <!-- Addresses -->
            <a wire:navigate href="{{ route('myaddresses') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('myaddresses*') ? 'bg-blue-50 dark:bg-blue-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('myaddresses*')
    ? 'bg-blue-100 dark:bg-blue-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40' }}">
                    <i class="fa-solid fa-location-dot
                        {{ request()->routeIs('myaddresses*')
    ? 'text-blue-600 dark:text-blue-400'
    : 'text-gray-500 group-hover:text-blue-600' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('myaddresses*')
    ? 'font-semibold text-blue-600 dark:text-blue-400'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Addresses
                </span>
            </a>
            <!-- Addresses -->
            <a wire:navigate href="{{ route('applytoretailer') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('applytoretailer*') ? 'bg-blue-50 dark:bg-blue-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('applytoretailer*')
    ? 'bg-blue-100 dark:bg-blue-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-blue-100 dark:group-hover:bg-blue-900/40' }}">
                    <i class="fa-solid fa-id-card
                        {{ request()->routeIs('applytoretailer*')
    ? 'text-blue-600 dark:text-blue-400'
    : 'text-gray-500 group-hover:text-blue-600' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('applytoretailer*')
    ? 'font-semibold text-blue-600 dark:text-blue-400'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Kyc Document

                </span>
            </a>

            <!-- Profile -->
            <a wire:navigate href="{{ route('profile') }}"
                class="group flex items-center gap-3 px-3 py-2.5 rounded-xl transition
               {{ request()->routeIs('profile*') ? 'bg-emerald-50 dark:bg-emerald-900/40' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                <span class="w-9 h-9 rounded-lg flex items-center justify-center transition
                    {{ request()->routeIs('profile*')
    ? 'bg-emerald-100 dark:bg-emerald-900/60'
    : 'bg-gray-100 dark:bg-gray-700 group-hover:bg-emerald-100 dark:group-hover:bg-emerald-900/40' }}">
                    <i class="fa-solid fa-user
                        {{ request()->routeIs('profile*')
    ? 'text-emerald-600 dark:text-emerald-400'
    : 'text-gray-500 group-hover:text-emerald-600' }}">
                    </i>
                </span>
                <span class="{{ request()->routeIs('profile*')
    ? 'font-semibold text-emerald-600 dark:text-emerald-400'
    : 'text-gray-700 dark:text-gray-200' }}">
                    Profile
                </span>
            </a>

        </nav>

        <!-- LOGOUT -->
        <div class="pt-4 mt-4 border-t dark:border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full group flex items-center gap-3 px-3 py-2.5 rounded-xl
                           text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 transition text-sm font-semibold">
                    <span class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-900/40
                                 flex items-center justify-center">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </span>
                    Logout
                </button>
            </form>
        </div>

    </div>
</aside>