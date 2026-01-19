<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800">

<!-- ================= TOP NAVBAR ================= -->
<header class="sticky top-0 z-50 bg-white border-b">
    <div class="max-w-7xl mx-auto px-5 h-16 flex items-center justify-between">

        <!-- Brand -->
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-purple-500 to-pink-500
                        text-white font-extrabold flex items-center justify-center">
                N
            </div>
            <span class="font-extrabold text-lg tracking-wide">
                newbie
            </span>
        </div>

        <!-- Right -->
        <div class="flex items-center gap-6">
            <span class="hidden sm:block text-sm font-semibold text-gray-600">
                Hi, {{ auth()->user()->name }}
            </span>

            <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-700
                        flex items-center justify-center font-bold">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
        </div>
    </div>
</header>

<!-- ================= WRAPPER ================= -->
<div class="max-w-7xl mx-auto px-5 py-8 flex gap-8">

    <!-- ================= SIDEBAR ================= -->
    <aside class="hidden lg:block w-64 shrink-0">
        <div class="bg-white rounded-3xl shadow-sm p-4">

            <p class="text-xs uppercase font-bold text-gray-400 px-3 mb-2">
                Account
            </p>

            <nav class="space-y-1 text-sm font-semibold">

                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          bg-purple-50 text-purple-700">
                    <i class="fa-solid fa-chart-pie"></i>
                    Dashboard
                </a>

                <a href="{{ route('myorders') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          hover:bg-gray-50">
                    <i class="fa-solid fa-bag-shopping text-gray-400"></i>
                    Orders
                </a>

                <a href="{{ route('wishlist') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          hover:bg-gray-50">
                    <i class="fa-solid fa-heart text-gray-400"></i>
                    Wishlist
                </a>

                <a href="{{ route('myaddresses') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          hover:bg-gray-50">
                    <i class="fa-solid fa-location-dot text-gray-400"></i>
                    Addresses
                </a>

                <a href="{{ route('profile') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          hover:bg-gray-50">
                    <i class="fa-solid fa-user text-gray-400"></i>
                    Profile
                </a>

            </nav>

            <div class="mt-6 pt-4 border-t">
                <a href="#logout"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl
                          text-red-500 hover:bg-red-50 font-semibold text-sm">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Logout
                </a>
            </div>

        </div>
    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 space-y-6">

        <!-- Page Slot -->
        <div class="bg-white rounded-3xl shadow-sm p-8 min-h-[400px]">
            {{ $slot }}
        </div>

    </main>
</div>

</body>
</html>
