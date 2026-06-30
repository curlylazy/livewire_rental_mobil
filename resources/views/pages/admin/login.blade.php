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

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            $this->addError('username', 'Username atau password salah.');
        }
        
        session()->regenerate();
        $this->redirect('/admin/dashboard');
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.app')
            ->title('Login Admin - ' . config('app.webname'));
    }
};

?>

<div class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-zinc-50 to-zinc-200 dark:from-zinc-950 dark:to-zinc-900 overflow-hidden font-sans">
    <!-- Glowing background decorative shapes -->
    <div class="absolute w-80 h-80 rounded-full bg-zinc-200/50 dark:bg-zinc-800/10 blur-3xl -top-12 -left-12 animate-pulse duration-[8000ms]"></div>
    <div class="absolute w-96 h-96 rounded-full bg-zinc-300/40 dark:bg-zinc-700/10 blur-3xl -bottom-20 -right-20 animate-pulse duration-[10000ms]"></div>
    
    <!-- Abstract 3D-like glass blobs -->
    <div class="absolute w-48 h-48 rounded-full bg-gradient-to-br from-zinc-300/30 to-zinc-400/20 top-1/4 left-10 md:left-20 transform -translate-y-1/2 blur-md shadow-lg hidden sm:block"></div>
    <div class="absolute w-64 h-64 rounded-full bg-gradient-to-tr from-zinc-400/20 to-zinc-500/10 bottom-1/4 right-10 md:right-20 transform translate-y-1/2 blur-md shadow-lg hidden sm:block"></div>

    <div class="relative w-full max-w-md px-4 mx-auto">
        <flux:card class="p-8 border border-zinc-200 dark:border-zinc-800/60 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-md shadow-2xl rounded-2xl">
            <!-- Brand / Header -->
            <div class="text-center mb-8">
                <flux:heading size="2xl" class="font-black tracking-tight text-zinc-900 dark:text-zinc-50">
                    Bali Car Rental
                </flux:heading>
                <flux:subheading class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                    Login Admin Portal
                </flux:subheading>
            </div>

            <!-- Validation/Error messages -->
            @if ($errors->has('login_failed'))
                <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-600 dark:text-red-400 rounded-lg text-sm">
                    {{ $errors->first('login_failed') }}
                </div>
            @endif

            <form wire:submit="login" class="space-y-6">
                <!-- Username Input -->
                <flux:field>
                    <flux:label class="text-zinc-700 dark:text-zinc-300">Username</flux:label>
                    <flux:input 
                        type="text" 
                        wire:model="username" 
                        placeholder="Masukkan username..." 
                        icon="user" 
                        class="bg-zinc-50/50 dark:bg-zinc-950/50 border-zinc-300 dark:border-zinc-800"
                        required
                    />
                    <flux:error name="username" />
                </flux:field>

                <!-- Password Input -->
                <flux:field>
                    <flux:label class="text-zinc-700 dark:text-zinc-300">Password</flux:label>
                    <flux:input 
                        type="password" 
                        wire:model="password" 
                        placeholder="••••••••" 
                        icon="key" 
                        class="bg-zinc-50/50 dark:bg-zinc-950/50 border-zinc-300 dark:border-zinc-800"
                        required
                    />
                    <flux:error name="password" />
                </flux:field>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <flux:checkbox wire:model="remember" label="Ingat saya" class="text-zinc-700 dark:text-zinc-300" />
                </div>

                <!-- Submit Button -->
                <flux:button 
                    type="submit" 
                    variant="primary" 
                    class="w-full bg-zinc-900 hover:bg-zinc-800 dark:bg-zinc-100 dark:hover:bg-zinc-200 text-white dark:text-zinc-900 font-semibold py-2.5 rounded-lg shadow-md transition-all duration-200 cursor-pointer"
                >
                    Sign in
                </flux:button>
            </form>

            <!-- Bottom Link/Footer -->
            <div class="mt-8 text-center border-t border-zinc-100 dark:border-zinc-800/80 pt-6">
                <flux:text size="sm" class="text-zinc-400">
                    &copy; {{ date('Y') }} Bali Car Rental. All rights reserved.
                </flux:text>
            </div>
        </flux:card>
    </div>
</div>
