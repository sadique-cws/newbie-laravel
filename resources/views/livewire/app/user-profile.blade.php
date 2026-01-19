<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <div class="flex gap-6">

        <!-- ===== SIDEBAR ===== -->
        @include('components.app.user-sidebar')

        <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 space-y-6">

            <!-- ===== PAGE HEADER ===== -->
            <div>
                <h1 class="text-2xl font-bold">My Profile</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Manage your personal information
                </p>
            </div>

            <!-- ===== PROFILE CARD ===== -->
            <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-2xl p-6 max-w-2xl">

                <!-- ===== USER INFO ===== -->
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-700
                               flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                <!-- ===== FORM ===== -->
                <form class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="text-sm font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-user text-gray-400"></i>
                            Full Name
                        </label>
                        <input type="text" value="{{ auth()->user()->name }}" class="w-full mt-1 border dark:border-gray-600 rounded-lg px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-envelope text-gray-400"></i>
                            Email
                        </label>
                        <input type="email" value="{{ auth()->user()->email }}" class="w-full mt-1 border dark:border-gray-600 rounded-lg px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="text-sm font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-phone text-gray-400"></i>
                            Phone
                        </label>
                        <input type="text" placeholder="Enter phone number" class="w-full mt-1 border dark:border-gray-600 rounded-lg px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="text-sm font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-lock text-gray-400"></i>
                            Password
                        </label>
                        <input type="password" placeholder="********" class="w-full mt-1 border dark:border-gray-600 rounded-lg px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p class="text-xs text-gray-500 mt-1">
                            Leave blank if you don’t want to change password
                        </p>
                    </div>

                    <!-- Submit -->
                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-semibold transition">
                            <i class="fa-solid fa-save"></i>
                            Update Profile
                        </button>
                    </div>

                </form>

            </div>

        </main>
    </div>
</div>