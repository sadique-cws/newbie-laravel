<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white dark:bg-gray-800 border-r border-gray-100 dark:border-gray-700 h-screen fixed overflow-y-auto">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('logo.png') }}" alt="Admin" class="h-8 w-auto">
                    <span class="text-xl font-bold text-gray-800 dark:text-gray-200">Admin Panel</span>
                </a>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-50 text-purple-700 border-r-4 border-purple-600' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors duration-200">
                    <span class="mx-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.products.*') ? 'bg-purple-50 text-purple-700 border-r-4 border-purple-600' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors duration-200">
                    <span class="mx-3">Products</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.orders.*') ? 'bg-purple-50 text-purple-700 border-r-4 border-purple-600' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700' }} transition-colors duration-200">
                    <span class="mx-3">Orders</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                    <span class="mx-3">Customers</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                    <span class="mx-3">Retailer KYC</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 ml-64 flex flex-col min-h-screen">
            <!-- Top Navbar -->
            <header class="bg-white dark:bg-gray-800 shadow z-10">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $header ?? 'Dashboard' }}
                    </h2>
                    <div class="flex items-center">
                        <!-- User Dropdown (Simplified) -->
                        <div class="ml-3 relative">
                            <div class="text-gray-500">{{ auth()->user()->name ?? 'Admin' }}</div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>

</html>