<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.shop')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $mobile = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'USER';

    /**
     * Get the validation rules.
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'mobile' => ['nullable', 'string', 'max:15'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:USER,RETAILER'],
        ];
    }

    /**
     * Handle real-time validation.
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        if ($user->isRetailer()) {
            $this->redirect(route('retailer.dashboard', absolute: false), navigate: true);
        } else {
            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
    }
}; ?>

<div class="min-h-[calc(100vh-64px)] bg-gray-50 dark:bg-gray-900 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-md w-full space-y-6 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-xl shadow-purple-100/50 dark:shadow-none border border-gray-100 dark:border-gray-700">
        <!-- Logo & Title -->
        <div class="text-center">
            <div class="flex justify-center mb-4">
                <img src="{{ asset('logo.png') }}" alt="Newbie" class="h-10 w-auto">
            </div>
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Sign up</h2>
            <p class="text-sm text-gray-500 mb-8">Create an account to start shopping</p>
        </div>

        <!-- Login/Register Toggle -->
        <div class="grid grid-cols-2 gap-1 bg-gray-100 p-1 rounded-xl mb-6">
            <a href="{{ route('login') }}" wire:navigate class="py-2.5 text-sm font-medium text-gray-500 hover:text-gray-900 rounded-lg transition-all text-center hover:bg-gray-50">Login</a>
            <button class="py-2.5 text-sm font-bold rounded-lg bg-white text-gray-900 shadow-sm transition-all text-center">Register</button>
        </div>

        <form wire:submit="register" class="space-y-5">

            <!-- Role Toggle -->
            <div class="grid grid-cols-2 gap-4">
                <label class="cursor-pointer relative">
                    <input type="radio" wire:model.live="role" value="USER" class="peer sr-only">
                    <div class="w-full py-2.5 flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 font-bold text-sm transition-all peer-checked:bg-white peer-checked:text-purple-700 peer-checked:border-purple-200 peer-checked:shadow-sm peer-checked:ring-1 peer-checked:ring-purple-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Consumer
                    </div>
                </label>
                <label class="cursor-pointer relative">
                    <input type="radio" wire:model.live="role" value="RETAILER" class="peer sr-only">
                    <div class="w-full py-2.5 flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 font-bold text-sm transition-all peer-checked:bg-white peer-checked:text-purple-700 peer-checked:border-purple-200 peer-checked:shadow-sm peer-checked:ring-1 peer-checked:ring-purple-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Retailer
                    </div>
                </label>
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Full Name</label>
                <input wire:model.blur="name" id="name" type="text" placeholder="Enter your full name" required autofocus class="w-full px-4 py-3 bg-gray-50 border-gray-200 focus:border-purple-500 focus:bg-white focus:ring-purple-500 rounded-xl text-gray-900 font-medium placeholder-gray-400 transition-all text-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Email</label>
                <input wire:model.blur="email" id="email" type="email" placeholder="name@example.com" required class="w-full px-4 py-3 bg-blue-50/50 border-transparent focus:border-purple-500 focus:bg-white focus:ring-purple-500 rounded-xl text-gray-900 font-medium placeholder-gray-400 transition-all text-sm">
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Mobile -->
            <div>
                <label for="mobile" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Mobile Number</label>
                <input wire:model.blur="mobile" id="mobile" type="tel" placeholder="Enter your mobile number" class="w-full px-4 py-3 bg-gray-50 border-gray-200 focus:border-purple-500 focus:bg-white focus:ring-purple-500 rounded-xl text-gray-900 font-medium placeholder-gray-400 transition-all text-sm">
                <x-input-error :messages="$errors->get('mobile')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Password</label>
                <div class="relative" x-data="{ show: false }">
                    <input wire:model.blur="password" id="password" :type="show ? 'text' : 'password'" required class="w-full px-4 py-3 bg-gray-50 border-gray-200 focus:border-purple-500 focus:bg-white focus:ring-purple-500 rounded-xl text-gray-900 font-medium placeholder-gray-400 transition-all text-sm">
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
                <p class="mt-1 text-[10px] text-gray-400">Min 8 chars, uppercase, lowercase & number</p>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Confirm Password</label>
                <div class="relative" x-data="{ show: false }">
                    <input wire:model.blur="password_confirmation" id="password_confirmation" :type="show ? 'text' : 'password'" placeholder="Confirm your password" required class="w-full px-4 py-3 bg-gray-50 border-gray-200 focus:border-purple-500 focus:bg-white focus:ring-purple-500 rounded-xl text-gray-900 font-medium placeholder-gray-400 transition-all text-sm">
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
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-purple-200 dark:shadow-none text-sm font-bold text-white bg-gradient-to-r from-[#A855F7] to-[#7C3AED] hover:from-[#9333EA] hover:to-[#6D28D9] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200 active:scale-95 uppercase tracking-wide">
                    Create Account
                </button>
            </div>
        </form>
    </div>
</div>