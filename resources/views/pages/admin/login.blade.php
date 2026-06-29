<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public $username = '';
    public $password = '';
    public $remember = false;

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['user' => $this->username, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        $this->addError('username', 'Username atau password salah.');
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.app')
            ->title('Login Admin - ' . config('app.webname'));
    }
};

?>

<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-tr from-sky-400 via-blue-500 to-indigo-700 overflow-hidden font-sans">
    <!-- Floating background decorative shapes -->
    <div class="absolute w-80 h-80 rounded-full bg-blue-300/30 blur-2xl -top-12 -left-12 animate-pulse duration-[6000ms]"></div>
    <div class="absolute w-96 h-96 rounded-full bg-cyan-300/20 blur-3xl -bottom-20 -right-20 animate-pulse duration-[8000ms]"></div>
    
    <!-- Abstract 3D-like glass blobs -->
    <div class="absolute w-48 h-48 rounded-full bg-gradient-to-br from-sky-300/40 to-blue-600/40 top-1/4 left-10 md:left-20 transform -translate-y-1/2 blur-xs shadow-lg hidden sm:block"></div>
    <div class="absolute w-64 h-64 rounded-full bg-gradient-to-tr from-indigo-300/30 to-purple-600/30 bottom-1/4 right-10 md:right-20 transform translate-y-1/2 blur-xs shadow-lg hidden sm:block"></div>
    
    <div class="absolute w-24 h-48 rounded-full bg-blue-400/20 rotate-45 top-1/3 right-1/4 blur-sm hidden lg:block"></div>
    <div class="absolute w-36 h-12 rounded-full bg-cyan-400/20 -rotate-12 bottom-1/3 left-1/4 blur-xs hidden lg:block"></div>

    <!-- Glassmorphic Card -->
    <div class="relative w-full max-w-md px-6 py-10 bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl shadow-[0_8px_32px_0_rgba(31,38,135,0.37)] mx-4">
        <!-- Brand / Header -->
        <div class="text-center mb-8">
            <span class="text-sm font-semibold tracking-wider text-blue-100 uppercase">Bali Car Rental</span>
            <h1 class="text-4xl font-extrabold text-white mt-1 tracking-tight">Login Admin</h1>
        </div>

        <form wire:submit.prevent="login" class="space-y-6">
            <!-- Username Input -->
            <div>
                <label for="username" class="block text-sm font-medium text-blue-100 mb-2">Username</label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="username" 
                        wire:model="username" 
                        placeholder="Enter username" 
                        class="w-full bg-white/95 border border-white/30 text-slate-800 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:bg-white placeholder-slate-400 font-sans transition duration-200"
                        required
                    />
                </div>
                @error('username')
                    <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password Input -->
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="text-sm font-medium text-blue-100">Password</label>
                    <a href="#" class="text-xs text-sky-200 hover:text-white transition duration-150">Forgot Password?</a>
                </div>
                <div class="relative">
                    <input 
                        type="password" 
                        id="password" 
                        wire:model="password" 
                        placeholder="••••••••" 
                        class="w-full bg-white/95 border border-white/30 text-slate-800 rounded-lg py-3 px-4 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:bg-white placeholder-slate-400 font-sans transition duration-200"
                        required
                    />
                </div>
                @error('password')
                    <span class="text-red-300 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    wire:model="remember" 
                    class="h-4 w-4 rounded border-white/30 bg-white/10 text-sky-600 focus:ring-sky-400 focus:ring-offset-0"
                />
                <label for="remember" class="ml-2 block text-sm text-blue-100 select-none cursor-pointer">Remember me</label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-900 hover:bg-blue-950 text-white font-bold py-3.5 px-4 rounded-lg transition-all duration-300 transform hover:scale-[1.02] shadow-[0_4px_20px_rgba(30,58,138,0.3)] focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2 focus:ring-offset-blue-700"
            >
                Sign in
            </button>
        </form>

        <!-- Bottom Link -->
        <div class="mt-8 text-center">
            <p class="text-sm text-blue-100">
                Don't have an account? 
                <a href="#" class="font-semibold text-white hover:underline transition duration-150">Register for free</a>
            </p>
        </div>
    </div>
</div>
