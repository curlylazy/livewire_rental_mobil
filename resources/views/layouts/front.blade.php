<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Bali Car Rental') }}</title>
    <meta name="description" content="Rental mobil di Bali dengan armada terawat, sopir profesional, dan chat WhatsApp 24/7 untuk kemudahan reservasi." />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fonts (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />

    <!-- Shared styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @livewireStyles
</head>
<body class="bg-[var(--canvas-night)] text-[var(--on-primary)]">

    <!-- Nav Dark (canvas-night) -->
    <header class="bg-[var(--canvas-night)]">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="font-semibold tracking-wide text-lg">Bali Car Rental</div>

                <nav class="hidden md:flex items-center gap-8 text-sm text-[rgba(255,255,255,0.9)]">
                    <a class="hover:text-white" href="#home">Beranda</a>
                    <a class="hover:text-white" href="#fleet">Armada</a>
                    <a class="hover:text-white" href="#services">Layanan</a>
                    <a class="hover:text-white" href="#about">Tentang Kami</a>
                    <a class="hover:text-white" href="#contact">Kontak</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a class="btn-pill btn-outline-on-dark hidden sm:inline-flex" href="#contact">Hubungi</a>
                    <a class="btn-pill btn-outline-on-dark" href="#contact">Chat 24/7</a>
                    <button
                        id="mobileMenuButton"
                        class="md:hidden text-white/90"
                        aria-label="menu"
                        aria-controls="mobileMenu"
                        aria-expanded="false"
                    >
                        ☰
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile menu -->
    <div id="mobileMenu" class="fixed inset-0 z-40 md:hidden pointer-events-none" aria-hidden="true">
        <div id="mobileMenuOverlay" class="absolute inset-0 bg-black/60 opacity-0 transition-opacity"></div>
        <div class="absolute right-0 top-0 h-full w-[85%] max-w-xs bg-[var(--canvas-night)] text-[var(--on-primary)] shadow-2xl transform translate-x-full transition-transform" role="dialog" aria-modal="true" aria-label="Menu navigasi">
            <div class="flex items-center justify-between px-5 py-4">
                <div class="font-semibold tracking-wide">Bali Car Rental</div>
                <button id="mobileMenuClose" class="text-white/90" aria-label="Tutup menu">✕</button>
            </div>
            <nav class="flex flex-col gap-1 px-5 pb-6">
                <a class="rounded-lg px-3 py-3 text-sm hover:bg-white/10" href="#home" data-mobile-nav-link>Beranda</a>
                <a class="rounded-lg px-3 py-3 text-sm hover:bg-white/10" href="#fleet" data-mobile-nav-link>Armada</a>
                <a class="rounded-lg px-3 py-3 text-sm hover:bg-white/10" href="#services" data-mobile-nav-link>Layanan</a>
                <a class="rounded-lg px-3 py-3 text-sm hover:bg-white/10" href="#about" data-mobile-nav-link>Tentang Kami</a>
                <a class="rounded-lg px-3 py-3 text-sm hover:bg-white/10" href="#contact" data-mobile-nav-link>Kontak</a>
                <div class="mt-3 h-px bg-white/10"></div>
                <a class="btn-pill btn-outline-on-dark mt-4 w-full justify-center" href="#contact" data-mobile-nav-link>Hubungi</a>
                <a class="btn-pill btn-outline-on-dark mt-3 w-full justify-center" href="#contact" data-mobile-nav-link>Chat 24/7</a>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-[var(--canvas-night)] text-[var(--on-primary)]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid gap-8 md:grid-cols-4">
                <div class="md:col-span-1">
                    <div class="text-lg font-semibold">Bali Car Rental</div>
                    <p class="mt-3 text-sm text-white/70">Perjalanan nyaman dan elegan di Pulau Dewata.</p>
                </div>
                <div>
                    <div class="text-sm font-semibold">Menu</div>
                    <ul class="mt-3 space-y-2 text-sm text-white/70">
                        <li><a class="hover:text-white" href="#fleet">Armada</a></li>
                        <li><a class="hover:text-white" href="#services">Layanan</a></li>
                        <li><a class="hover:text-white" href="#about">Tentang Kami</a></li>
                        <li><a class="hover:text-white" href="#contact">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <div class="text-sm font-semibold">Keunggulan</div>
                    <ul class="mt-3 space-y-2 text-sm text-white/70">
                        <li>Chat 24/7</li>
                        <li>Armada Prima</li>
                        <li>Sopir Profesional</li>
                    </ul>
                </div>
                <div>
                    <div class="text-sm font-semibold">CTA</div>
                    <a class="btn-pill btn-outline-on-dark mt-3" href="#contact" onclick="document.getElementById('wa-link').click(); return false;">Chat via WhatsApp</a>
                    <div class="mt-3 text-xs text-white/50">© <span id="year"></span> Bali Car Rental. All rights reserved.</div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp -->
    <div class="wa-float">
        <a class="btn-pill btn-primary" href="https://wa.me/6281234567890" target="_blank" rel="noreferrer" aria-label="Chat WhatsApp 24/7">
            <span class="mr-2">💬</span> WhatsApp 24/7
        </a>
    </div>

    <script>
        document.getElementById('year').textContent = new Date().getFullYear();

        (function () {
            const button = document.getElementById('mobileMenuButton');
            const menu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileMenuOverlay');
            const closeBtn = document.getElementById('mobileMenuClose');
            const navLinks = menu ? menu.querySelectorAll('[data-mobile-nav-link]') : [];

            if (!button || !menu || !overlay || !closeBtn) return;

            function isOpen() { return menu.getAttribute('data-open') === 'true'; }
            function setOpen(open) {
                menu.setAttribute('data-open', open ? 'true' : 'false');
                if (open) {
                    menu.classList.remove('pointer-events-none', 'opacity-0');
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                    menu.setAttribute('aria-hidden', 'false');
                    button.setAttribute('aria-expanded', 'true');
                    const drawer = menu.querySelector('div.absolute.right-0');
                    if (drawer) drawer.classList.remove('translate-x-full');
                } else {
                    overlay.classList.add('opacity-0');
                    overlay.classList.remove('opacity-100');
                    menu.setAttribute('aria-hidden', 'true');
                    button.setAttribute('aria-expanded', 'false');
                    const drawer = menu.querySelector('div.absolute.right-0');
                    if (drawer) drawer.classList.add('translate-x-full');
                    menu.classList.add('pointer-events-none');
                }
            }

            setOpen(false);
            button.addEventListener('click', function () { setOpen(!isOpen()); });
            closeBtn.addEventListener('click', function () { setOpen(false); });
            overlay.addEventListener('click', function () { setOpen(false); });
            navLinks.forEach(function (link) { link.addEventListener('click', function () { setOpen(false); }); });
            window.addEventListener('resize', function () { if (window.innerWidth >= 768) setOpen(false); });
        })();
    </script>
    @livewireScripts
</body>
</html>
