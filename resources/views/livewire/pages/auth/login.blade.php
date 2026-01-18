<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.shop')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle real-time validation.
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $user = auth()->user();

        $redirectRoute = match (true) {
            $user->isAdmin() => route('admin.dashboard', absolute: false),
            $user->isRetailer() => route('retailer.dashboard', absolute: false),
            default => route('dashboard', absolute: false),
        };

        $this->redirectIntended(default: $redirectRoute, navigate: true);
    }
}; ?>

<div class="min-h-[calc(100vh-64px)] bg-gray-50 dark:bg-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl shadow-purple-100/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('logo.png') }}" alt="Newbie" class="h-10 w-auto">
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Log in</h2>
            <p class="text-sm text-gray-500 mb-8">Access your orders and account details</p>
        </div>

        <!-- Toggle -->
        <div class="grid grid-cols-2 gap-1 bg-gray-100 p-1 rounded-xl mb-8">
            <button class="py-2.5 text-sm font-bold rounded-lg bg-white text-gray-900 shadow-sm transition-all text-center">Login</button>
            <a href="{{ route('register') }}" wire:navigate class="py-2.5 text-sm font-medium text-gray-500 hover:text-gray-900 rounded-lg transition-all text-center hover:bg-gray-50">Register</a>
        </div>

        <form wire:submit="login" class="space-y-6">
            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email Address</label>
                <input wire:model.blur="form.email" id="email" type="email" required autofocus class="w-full px-4 py-3 bg-blue-50/50 dark:bg-gray-900 border-transparent focus:border-purple-500 focus:bg-white dark:focus:bg-gray-800 focus:ring-0 rounded-xl text-gray-900 dark:text-white font-medium placeholder-gray-400 transition-all duration-200">
                <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Password</label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" wire:navigate class="text-xs font-bold text-purple-600 hover:text-purple-500">
                        Forgot password?
                    </a>
                    @endif
                </div>
                <div class="relative" x-data="{ show: false }">
                    <input wire:model.blur="form.password" id="password" :type="show ? 'text' : 'password'" required autocomplete="current-password" class="w-full px-4 py-3 bg-blue-50/50 dark:bg-gray-900 border-transparent focus:border-purple-500 focus:bg-white dark:focus:bg-gray-800 focus:ring-0 rounded-xl text-gray-900 dark:text-white font-medium placeholder-gray-400 transition-all duration-200">
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" x-show="!show" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg class="h-5 w-5" x-show="show" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Keep me logged in
                </label>
            </div>

            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-purple-200 dark:shadow-none text-sm font-bold text-white bg-gradient-to-r from-[#A855F7] to-[#7C3AED] hover:from-[#9333EA] hover:to-[#6D28D9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 active:scale-95 uppercase tracking-wide">
                Log In
                <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white dark:bg-gray-800 text-gray-400 font-bold text-[10px] uppercase tracking-widest">Or continue with</span>
            </div>
        </div>

        <div>
            <button type="button" class="w-full flex items-center justify-center px-4 py-3.5 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm bg-white dark:bg-gray-900 text-sm font-bold text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-800 transition-all active:scale-95">
                <svg class="h-5 w-5 mr-3" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4" />
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853" />
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05" />
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335" />
                </svg>
                Continue with Google
            </button>
        </div>
    </div>
</div>