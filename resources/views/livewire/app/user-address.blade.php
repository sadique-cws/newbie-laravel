<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex gap-6">

        <!-- ===== SIDEBAR INCLUDE ===== -->
        @include('components.app.user-sidebar')

        <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 space-y-6">

            <!-- ===== PAGE HEADER ===== -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold">My Addresses</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Manage your delivery addresses
                    </p>
                </div>

                <a href="#add-address" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg
                           bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-semibold">
                    <i class="fa-solid fa-plus"></i>
                    Add New Address
                </a>
            </div>

            <!-- ===== ADDRESS GRID ===== -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                <!-- ===== ADDRESS CARD ===== -->
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-4 space-y-3">

                    <div class="flex justify-between items-start">
                        <p class="font-semibold text-sm">Home</p>
                        <span class="text-xs px-2 py-1 rounded-full
                                   bg-green-100 text-green-600 font-semibold">
                            Default
                        </span>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        <strong>Ankur Jha</strong><br>
                        221B, Baker Street<br>
                        New Delhi, Delhi – 110001
                    </p>

                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        <i class="fa-solid fa-phone mr-1"></i>
                        9876543210
                    </p>

                    <div class="flex gap-4 pt-2 text-sm font-semibold">
                        <a href="#edit" class="text-blue-600 hover:underline">
                            <i class="fa-solid fa-pen mr-1"></i> Edit
                        </a>
                        <a href="#delete" class="text-red-500 hover:underline">
                            <i class="fa-solid fa-trash mr-1"></i> Delete
                        </a>
                    </div>

                </div>

                <!-- ===== ADDRESS CARD ===== -->
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-4 space-y-3">

                    <p class="font-semibold text-sm">Office</p>

                    <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                        <strong>Ankur Jha</strong><br>
                        Cyber City, DLF Phase 2<br>
                        Gurugram, Haryana – 122002
                    </p>

                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                        <i class="fa-solid fa-phone mr-1"></i>
                        9876543210
                    </p>

                    <div class="flex gap-4 pt-2 text-sm font-semibold">
                        <a href="#edit" class="text-blue-600 hover:underline">
                            <i class="fa-solid fa-pen mr-1"></i> Edit
                        </a>
                        <a href="#delete" class="text-red-500 hover:underline">
                            <i class="fa-solid fa-trash mr-1"></i> Delete
                        </a>
                    </div>

                </div>

            </div>

        </main>

    </div>
</div>