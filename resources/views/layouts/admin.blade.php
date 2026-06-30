<!DOCTYPE html><!--
    * CoreUI - Free Bootstrap Admin Template
    * @version v5.1.0
    * @link https://coreui.io/product/free-bootstrap-admin-template/
    * Copyright (c) 2024 creativeLabs Łukasz Holeczek
    * Licensed under MIT (https://github.com/coreui/coreui-free-bootstrap-admin-template/blob/main/LICENSE)
    -->
    <html lang="en">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="Sistem Konveksi - Aplikasi Online Manajemen Konveksi">
        <meta name="author" content="Balicoding.com">
        <meta name="keyword" content="">
        <title>{{ $title ?? 'Admin '.config('app.webname') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

        {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

        {{-- Fav-Icon --}}
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @fluxAppearance
        @livewireStyles
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
        <flux:sidebar sticky collapsible="mobile" class="bg-slate-100 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.header>
                <flux:sidebar.brand
                    href="/admin/dashboard"
                    logo="{{ asset('logo.png') }}"
                    name="{{ config('app.webname') }}"
                />
                <flux:sidebar.collapse class="lg:hidden" />
            </flux:sidebar.header>
            <flux:sidebar.search placeholder="Search..." />
            <flux:sidebar.nav>
                <flux:sidebar.item icon="home" wire:navigate href="/admin/dashboard" :current="request()->is('admin/dashboard')">Dashboard</flux:sidebar.item>
                <flux:sidebar.item icon="users" wire:navigate href="/admin/user" :current="request()->is('admin/user', 'admin/user/*')">User</flux:sidebar.item>
                <flux:sidebar.item icon="user-group" wire:navigate href="/admin/pelanggan" :current="request()->is('admin/pelanggan', 'admin/pelanggan/*')">Pelanggan</flux:sidebar.item>
                <flux:sidebar.item icon="briefcase" wire:navigate href="/admin/projek" :current="request()->is('admin/projek', 'admin/projek/*')">Projek</flux:sidebar.item>
                <flux:sidebar.item icon="credit-card" wire:navigate href="/admin/rekening" :current="request()->is('admin/rekening', 'admin/rekening/*')">Rekening</flux:sidebar.item>
                <flux:sidebar.item icon="document-text" wire:navigate href="/admin/invoice" :current="request()->is('admin/invoice', 'admin/invoice/*')">Invoice</flux:sidebar.item>
                <flux:sidebar.item icon="photo" wire:navigate href="/admin/galeri" :current="request()->is('admin/galeri', 'admin/galeri/*')">Galeri</flux:sidebar.item>
                <flux:sidebar.item icon="newspaper" wire:navigate href="/admin/blog" :current="request()->is('admin/blog', 'admin/blog/*')">Blog</flux:sidebar.item>
            </flux:sidebar.nav>
            <flux:sidebar.spacer />

            <div x-data="{ appearance: window.localStorage.getItem('flux.appearance') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light') }" class="px-2">
                <div class="flex items-center gap-0.5 p-0.5 bg-zinc-200/60 dark:bg-zinc-950/50 border border-zinc-200/50 dark:border-zinc-800/50 rounded-lg">
                    <button 
                        type="button" 
                        x-on:click="appearance = 'light'; Livewire.dispatch('set-theme', { theme: 'light' })"
                        class="flex-1 flex justify-center items-center gap-1.5 py-1.5 rounded-md text-xs font-medium transition-all duration-200 cursor-pointer"
                        :class="appearance === 'light' ? 'bg-white dark:bg-zinc-800 text-zinc-800 dark:text-white shadow-xs border border-zinc-200/20 dark:border-zinc-700' : 'text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200 border border-transparent'"
                    >
                        <flux:icon name="sun" variant="micro" class="size-4" />
                        <span>Light</span>
                    </button>
                    <button 
                        type="button" 
                        x-on:click="appearance = 'dark'; Livewire.dispatch('set-theme', { theme: 'dark' })"
                        class="flex-1 flex justify-center items-center gap-1.5 py-1.5 rounded-md text-xs font-medium transition-all duration-200 cursor-pointer"
                        :class="appearance === 'dark' ? 'bg-white dark:bg-zinc-800 text-zinc-800 dark:text-white shadow-xs border border-zinc-200/20 dark:border-zinc-700' : 'text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200 border border-transparent'"
                    >
                        <flux:icon name="moon" variant="micro" class="size-4" />
                        <span>Dark</span>
                    </button>
                </div>
            </div>

            <flux:dropdown position="top" align="start" class="max-lg:hidden">
                <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="{{ Auth::user()->namauser ?? 'User' }}" />
                <flux:menu>
                    <flux:menu.item icon="arrow-right-start-on-rectangle" href="{{ url('/logout') }}" wire:navigate>Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>


        
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
            <flux:spacer />
            <flux:dropdown position="top" align="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />
                <flux:menu>
                    <flux:menu.item icon="arrow-right-start-on-rectangle" href="{{ url('/logout') }}" wire:navigate>Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>




        <flux:main class='light:bg-slate-50'>
            {{ $slot }}
        </flux:main>

        {{-- *** modal error --}}
        <x-partials.modal-error></x-partials.modal-error>

        @persist('toast')
            <flux:toast position="top end" />
        @endpersist

        {!! $js ?? '' !!}
        @livewireScripts
        @fluxScripts

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('livewire:navigated', (event) => {

                var default_theme = window.localStorage.getItem('flux.appearance');

                Livewire.on('set-theme', (e) => {
                    Flux.appearance = e.theme;
                    window.localStorage.setItem('flux.appearance', e.theme);
                });

                Livewire.on('notif', (e) => {
                    Swal.fire({
                        text: e.message,
                        icon: e.icon
                    });
                });

                Livewire.on('error', (e) => {
                    console.log(e.message);
                    Flux.modal('modalError').show();
                });

                Livewire.on('copy-to-clipboard', (e) => {
                    navigator.clipboard.writeText(e.url);
                    Livewire.dispatch('notif', { message: "Berhasil copy URL, silahkan paste URL tersebut di platform mana saja.", icon: "success" });
                });
            });
        </script>
    </body>
</html>
