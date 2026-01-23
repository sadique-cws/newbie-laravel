<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">

    <div x-data="{ sidebarOpen: true }" class="relative min-h-screen">

        <!-- OVERLAY (MOBILE ONLY) -->
        <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false"
            class="fixed inset-0 bg-black/50 z-40 md:hidden">
        </div>

        <!-- SIDEBAR -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64
        bg-white dark:bg-gray-800
        border-r border-gray-200 dark:border-gray-700
        flex flex-col
        transform transition-transform duration-300
        md:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">

            <!-- BRAND -->
            <div class="h-16 flex items-center justify-between px-6 border-b dark:border-gray-700">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" class="h-8" alt="Admin">
                </a>

                <!-- CLOSE (MOBILE) -->
                <button @click="sidebarOpen = false"
                    class="md:hidden text-gray-500 hover:text-gray-800 dark:hover:text-white text-xl">
                    ✕
                </button>
            </div>

            <!-- NAV -->
            <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold transition
               {{ request()->routeIs('admin.dashboard')
    ? 'bg-purple-50 text-purple-700 dark:bg-purple-900/20 dark:text-purple-400'
    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold transition
               {{ request()->routeIs('admin.products.*')
    ? 'bg-purple-50 text-purple-700 dark:bg-purple-900/20 dark:text-purple-400'
    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Products
                </a>

                <a href="{{ route('admin.orders.index') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold transition
               {{ request()->routeIs('admin.orders.*')
    ? 'bg-purple-50 text-purple-700 dark:bg-purple-900/20 dark:text-purple-400'
    : 'text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Orders
                </a>

                <a href="#"
                    class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Customers
                </a>

                <a wire:navigate href="{{ route('admin.reviewretailer') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-semibold text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                    Retailer KYC
                </a>
            </nav>

            <!-- LOGOUT -->
            <div class="border-t dark:border-gray-700 p-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center justify-center gap-2
                    px-4 py-2 rounded-lg
                    text-red-600 font-semibold
                    hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div class="ml-64 flex flex-col min-h-screen">

            <!-- HEADER -->
            <header class="sticky top-0 z-30 h-16
            bg-white dark:bg-gray-800
            border-b dark:border-gray-700
            flex items-center justify-between
            px-4 md:px-6">

                <div class="flex items-center gap-3">
                    <!-- TOGGLE -->
                    <button @click="sidebarOpen = true" class="md:hidden text-gray-600 dark:text-gray-300 text-xl">
                        ☰
                    </button>

                    <h1 class="font-semibold text-lg text-gray-800 dark:text-gray-200">
                        {{ $header ?? 'Dashboard' }}
                    </h1>
                </div>

                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ auth()->user()->name ?? 'Admin' }}
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="flex-1 overflow-y-auto p-4 md:p-6">
                {{ $slot }}
            </main>
        </div>

    </div>
</body>

</html>