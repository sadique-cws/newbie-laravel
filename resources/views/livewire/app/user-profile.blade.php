<div>
    <!-- ===== PAGE HEADER ===== -->
    <div class="mb-6">
        <h1 class="text-xl sm:text-2xl font-bold">My Profile</h1>
        <p class="text-sm text-gray-500">
            Manage your personal information
        </p>
    </div>

    <!-- ===== PROFILE WRAPPER ===== -->
    <div class="bg-white border rounded-xl p-6 max-w-2xl">

        <!-- Avatar -->
        <div class="flex items-center gap-4 mb-6">
            <div class="w-14 h-14 rounded-full bg-purple-100 text-purple-700
                    flex items-center justify-center font-bold text-lg">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <p class="font-semibold">{{ auth()->user()->name }}</p>
                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <!-- Form -->
        <form class="space-y-4">

            <div>
                <label class="text-sm font-semibold">Full Name</label>
                <input type="text" value="{{ auth()->user()->name }}" class="w-full mt-1 border rounded-lg px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="text-sm font-semibold">Email</label>
                <input type="email" value="{{ auth()->user()->email }}" class="w-full mt-1 border rounded-lg px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="text-sm font-semibold">Phone</label>
                <input type="text" placeholder="Enter phone number" class="w-full mt-1 border rounded-lg px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="text-sm font-semibold">Password</label>
                <input type="password" placeholder="********" class="w-full mt-1 border rounded-lg px-4 py-2 text-sm
                          focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <button type="submit" class="w-full sm:w-auto px-6 py-2 rounded-lg
                       bg-purple-600 text-white text-sm font-semibold
                       hover:bg-purple-700">
                Update Profile
            </button>

        </form>

    </div>

</div>