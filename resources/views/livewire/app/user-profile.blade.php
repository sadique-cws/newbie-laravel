<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex gap-6">

        {{-- SIDEBAR --}}
        @include('components.app.user-sidebar')

        {{-- MAIN --}}
        <main class="flex-1 space-y-6">

            {{-- HEADER --}}
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    My Profile
                </h1>
                <p class="text-sm text-gray-500">
                    Update your personal information
                </p>
            </div>

            {{-- SUCCESS MESSAGE --}}
            @if(session()->has('success'))
                <div class="bg-green-50 text-green-700 text-sm px-4 py-2 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- PROFILE CARD --}}
            <div class="bg-white dark:bg-gray-800 border dark:border-gray-700
                        rounded-2xl p-6 max-w-2xl">

                {{-- USER INFO --}}
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-14 h-14 rounded-full bg-blue-100 text-blue-700
                                flex items-center justify-center font-bold text-lg">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold text-gray-900 dark:text-white">
                            {{ auth()->user()->name }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>
                </div>

                {{-- FORM --}}
                <form wire:submit.prevent="updateProfile" class="space-y-4">

                    {{-- NAME --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Full Name
                        </label>
                        <input type="text" wire:model.defer="name" class="w-full mt-1 rounded-md border border-gray-300 dark:border-gray-700
                                   px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-white
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input type="email" wire:model.defer="email" readonly class="cursor-not-allowed w-full mt-1 rounded-md border border-gray-300 dark:border-gray-700
                                   px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-white
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Phone
                        </label>
                        <input type="text" wire:model.defer="phone" placeholder="Enter phone number" class="w-full mt-1 rounded-md border border-gray-300 dark:border-gray-700
                                   px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-white
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                            New Password
                        </label>
                        <input type="password" wire:model.defer="password"
                            placeholder="Leave blank to keep current password" class="w-full mt-1 rounded-md border border-gray-300 dark:border-gray-700
                                   px-4 py-2 text-sm
                                   bg-white dark:bg-gray-900
                                   text-gray-900 dark:text-white
                                   placeholder:text-gray-400
                                   focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- SUBMIT --}}
                    <div class="pt-2">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 rounded-md
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