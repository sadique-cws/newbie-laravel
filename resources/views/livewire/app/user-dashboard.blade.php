<div>
    <!-- ===== WELCOME ===== -->
    <div class="mb-6">
        <h1 class="text-xl sm:text-2xl font-bold">
            Hello, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-sm text-gray-500">
            Your account overview
        </p>
    </div>

    <!-- ===== STATS (2 per row on mobile) ===== -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Total Orders</p>
            <h2 class="text-2xl font-bold mt-1">12</h2>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Pending</p>
            <h2 class="text-2xl font-bold mt-1 text-orange-500">3</h2>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Wishlist</p>
            <h2 class="text-2xl font-bold mt-1 text-pink-500">8</h2>
        </div>

        <div class="bg-white rounded-xl p-4 shadow-sm">
            <p class="text-xs text-gray-500">Addresses</p>
            <h2 class="text-2xl font-bold mt-1 text-green-600">2</h2>
        </div>

    </div>

    <!-- ===== RECENT ORDERS ===== -->
    <div class="mt-8 bg-white rounded-xl shadow-sm p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="font-bold text-lg">Recent Orders</h2>
            <a href="#orders" class="text-sm text-purple-600 font-semibold">
                View all
            </a>
        </div>

        <div class="space-y-3">

            <div class="flex justify-between items-center border rounded-lg p-3">
                <div>
                    <p class="font-semibold text-sm">#ORD-1023</p>
                    <p class="text-xs text-gray-500">12 Jan 2026</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-sm">₹2,499</p>
                    <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-600">
                        Pending
                    </span>
                </div>
            </div>

            <div class="flex justify-between items-center border rounded-lg p-3">
                <div>
                    <p class="font-semibold text-sm">#ORD-1019</p>
                    <p class="text-xs text-gray-500">05 Jan 2026</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-sm">₹1,799</p>
                    <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-600">
                        Delivered
                    </span>
                </div>
            </div>

        </div>
    </div>

</div>