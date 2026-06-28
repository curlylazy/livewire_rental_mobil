<x-front-layout>
    <!-- Hero (cinematic) -->
    <section id="home" class="relative flex w-full items-center bg-[var(--canvas-night)] min-h-[70vh] lg:min-h-screen">
        <div class="pointer-events-none absolute inset-0">
            <img class="h-full w-full object-cover" src="banner.png" alt="Foto mobil mewah" />
            <div class="absolute inset-0 bg-black/60"></div>
        </div>
        <div class="relative w-full mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid items-center gap-10 pb-16 pt-14 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/5 px-3 py-1 text-xs text-white/80">
                        <span class="h-2 w-2 rounded-full bg-[var(--aloe-10)]"></span>
                        <span>Rental Mobil di Bali</span>
                    </div>
                    <h1 class="mt-6 display-xxl font-medium">Perjalanan Nyaman dan Elegan di Pulau Dewata</h1>
                    <p class="mt-5 max-w-2xl text-base sm:text-lg text-white/85">
                        Armada terawat, sopir profesional, dan chat WhatsApp 24/7 untuk bantuan darurat maupun reservasi.
                    </p>
                    <div class="mt-7 flex flex-col sm:flex-row gap-3">
                        <a class="btn-pill btn-outline-on-dark" href="#fleet">Lihat Armada</a>
                        <a class="btn-pill btn-primary" href="#contact" onclick="document.getElementById('wa-link').click(); return false;">Chat via WhatsApp 24/7</a>
                    </div>
                </div>
                <div class="lg:col-span-5">
                    <div class="rounded-2xl bg-black/40 p-5 ring-1 ring-white/10 backdrop-blur">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-semibold">Preview Armada</div>
                                <div class="mt-1 text-sm text-white/75">Pilih kategori sesuai kebutuhan Anda.</div>
                            </div>
                            <div class="rounded-full bg-white/10 px-3 py-1 text-xs text-white/80">Bali</div>
                        </div>
                        <div class="mt-5 grid gap-3">
                            <a href="#fleet" class="group flex items-center justify-between rounded-xl bg-white/5 p-4 hover:bg-white/10 transition">
                                <div>
                                    <div class="text-sm font-semibold">SUV</div>
                                    <div class="mt-1 text-xs text-white/70">Terios, Rush</div>
                                </div>
                                <span class="text-white/80">→</span>
                            </a>
                            <a href="#fleet" class="group flex items-center justify-between rounded-xl bg-white/5 p-4 hover:bg-white/10 transition">
                                <div>
                                    <div class="text-sm font-semibold">Mobil Keluarga</div>
                                    <div class="mt-1 text-xs text-white/70">APV, HiACE, Innova</div>
                                </div>
                                <span class="text-white/80">→</span>
                            </a>
                            <a href="#fleet" class="group flex items-center justify-between rounded-xl bg-white/5 p-4 hover:bg-white/10 transition">
                                <div>
                                    <div class="text-sm font-semibold">Luxury</div>
                                    <div class="mt-1 text-xs text-white/70">Alphard, Vellfire</div>
                                </div>
                                <span class="text-white/80">→</span>
                            </a>
                        </div>
                        <div class="mt-5">
                            <a class="btn-pill btn-outline-on-dark w-full" href="#contact">Konsultasi Paket</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="text-[var(--ink)]">
        <!-- Armada -->
        <section id="fleet" class="bg-[var(--canvas-light)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <div class="text-xs font-semibold tracking-wide text-black/60 uppercase">Armada</div>
                        <h2 class="mt-2 text-4xl sm:text-5xl font-medium">Katalog Armada Terpopuler</h2>
                        <p class="mt-3 max-w-2xl text-sm sm:text-base text-black/70">SUV, mobil keluarga, hingga luxury—siap untuk perjalanan Anda di Bali.</p>
                    </div>
                    <div class="hidden sm:block">
                        <div class="rounded-full bg-black/5 px-4 py-2 text-sm">Harga fleksibel • Reservasi cepat</div>
                    </div>
                </div>
                <div class="mt-10 grid gap-6 lg:grid-cols-3">
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] overflow-hidden">
                        <div class="relative">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1542365887-0c0f4d3f7b15?auto=format&fit=crop&w=1400&q=80" alt="SUV" />
                            <div class="absolute left-4 top-4 rounded-full bg-black/70 px-3 py-1 text-xs text-white">SUV</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">Terios & Rush</h3>
                            <p class="mt-2 text-sm text-black/70">Cocok untuk wisata keluarga, fleksibel untuk berbagai akses jalan di Bali.</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[var(--aloe-10)] px-3 py-1 text-xs font-medium">Terios</span>
                                <span class="rounded-full bg-[var(--aloe-10)] px-3 py-1 text-xs font-medium">Rush</span>
                            </div>
                            <div class="mt-6">
                                <a class="btn-pill btn-outline-on-light w-full" href="#contact">Tanya Ketersediaan</a>
                            </div>
                        </div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-white overflow-hidden">
                        <div class="relative">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=1400&q=80" alt="Mobil keluarga" />
                            <div class="absolute left-4 top-4 rounded-full bg-black/70 px-3 py-1 text-xs text-white">Mobil Besar / Keluarga</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">APV, HiACE, Innova</h3>
                            <p class="mt-2 text-sm text-black/70">Untuk rombongan, lebih lega dan nyaman selama perjalanan wisata.</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-black/5 px-3 py-1 text-xs font-medium">APV</span>
                                <span class="rounded-full bg-black/5 px-3 py-1 text-xs font-medium">HiACE</span>
                                <span class="rounded-full bg-black/5 px-3 py-1 text-xs font-medium">Innova</span>
                            </div>
                            <div class="mt-6">
                                <a class="btn-pill btn-outline-on-light w-full" href="#services">Lihat Paket</a>
                            </div>
                        </div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] overflow-hidden">
                        <div class="relative">
                            <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1511910849309-0dff7c6e6f8c?auto=format&fit=crop&w=1400&q=80" alt="Luxury" />
                            <div class="absolute left-4 top-4 rounded-full bg-black/70 px-3 py-1 text-xs text-white">Luxury</div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold">Alphard & Vellfire</h3>
                            <p class="mt-2 text-sm text-black/70">Tampil elegan dan memberikan kenyamanan maksimal untuk momen spesial Anda.</p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-[var(--aloe-10)] px-3 py-1 text-xs font-medium">Alphard</span>
                                <span class="rounded-full bg-[var(--aloe-10)] px-3 py-1 text-xs font-medium">Vellfire</span>
                            </div>
                            <div class="mt-6">
                                <a class="btn-pill btn-outline-on-light w-full" href="#contact">Booking Sekarang</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Services -->
        <section id="services" class="bg-[var(--canvas-light)] border-t border-[var(--hairline-light)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                <div class="mb-12 text-center sm:text-left">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black/5 px-3 py-2">
                        <span class="h-2.5 w-2.5 rounded-full bg-[var(--aloe-10)]"></span>
                        <span class="text-sm font-semibold">Layanan Kami</span>
                    </div>
                    <h2 class="mt-4 text-4xl sm:text-5xl font-medium">Layanan Perjalanan Anda</h2>
                    <p class="mt-3 text-sm sm:text-base text-black/70">Berbagai solusi transportasi profesional untuk melengkapi aktivitas dan mobilitas Anda di Bali.</p>
                </div>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-4">
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Perjalanan Dinas / VVIP</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Solusi transportasi profesional untuk kebutuhan perjalanan bisnis, meeting, ataupun tamu penting.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Event / Gathering</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Memudahkan transportasi untuk acara perusahaan, komunitas, maupun keluarga besar.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Private / Group Tour</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Layanan perjalanan wisata yang fleksibel untuk pribadi maupun rombongan.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">City Touring</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Jelajahi berbagai tempat menarik di Bali dengan layanan city tour yang nyaman.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Antar / Jemput Kota</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Layanan antar jemput yang fleksibel untuk perjalanan dalam kota maupun luar kota.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Antar / Jemput Bandara</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Nikmati perjalanan dari dan menuju bandara tanpa ribet.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Wisata / Outbound</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Cocok untuk kegiatan wisata maupun outbound bersama teman, keluarga, atau tim perusahaan.</div>
                    </article>
                    <article class="rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] p-6 hover:shadow-sm transition-shadow">
                        <div class="text-base font-semibold">Wedding Car</div>
                        <div class="mt-3 text-sm text-black/70 leading-relaxed">Mobil elegan untuk melengkapi momen spesial pernikahan Anda.</div>
                    </article>
                </div>
                <div class="mt-10 rounded-2xl bg-[var(--pistachio-10)] p-6 md:p-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <div class="text-base font-semibold">Butuh rekomendasi armada atau layanan khusus?</div>
                            <div class="mt-1 text-sm text-black/70">Kirim detail tanggal perjalanan dan jumlah rombongan Anda untuk layanan terbaik.</div>
                        </div>
                        <a class="btn-pill btn-primary whitespace-nowrap" href="#contact" onclick="document.getElementById('wa-link').click(); return false;">Chat WhatsApp Sekarang</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- About -->
        <section id="about" class="bg-[var(--canvas-cream)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid gap-8 lg:grid-cols-12 lg:items-center">
                    <div class="lg:col-span-5">
                        <div class="rounded-2xl overflow-hidden border border-[var(--hairline-light)] bg-white">
                            <img class="h-72 w-full object-cover" src="https://images.unsplash.com/photo-1507133750040-4a8f57021571?auto=format&fit=crop&w=1400&q=80" alt="Tim profesional" />
                        </div>
                    </div>
                    <div class="lg:col-span-7">
                        <div class="inline-flex items-center gap-2 rounded-full bg-black/5 px-3 py-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-[var(--pistachio-10)]"></span>
                            <span class="text-sm font-semibold">Tentang Kami</span>
                        </div>
                        <h2 class="mt-4 text-4xl sm:text-5xl font-medium">Visi & komitmen Bali Car Rental</h2>
                        <div class="mt-5 grid gap-4 md:grid-cols-2">
                            <div class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6">
                                <div class="text-sm font-semibold">Visi</div>
                                <p class="mt-2 text-sm text-black/70">Menjadi pilihan utama rental mobil di Bali dengan layanan yang rapi, aman, dan terpercaya.</p>
                            </div>
                            <div class="rounded-2xl border border-[var(--hairline-light)] bg-white p-6">
                                <div class="text-sm font-semibold">Misi</div>
                                <ul class="mt-2 space-y-2 text-sm text-black/70">
                                    <li>• Menyediakan armada terawat dan layak jalan.</li>
                                    <li>• Memberikan sopir profesional dan responsif.</li>
                                    <li>• Memastikan kemudahan reservasi lewat chat 24/7.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="mt-5 rounded-2xl bg-white p-6 border border-[var(--hairline-light)]">
                            <div class="text-sm font-semibold">Komitmen pelayanan</div>
                            <p class="mt-2 text-sm text-black/70">Setiap perjalanan kami rancang agar terasa nyaman—dari penjemputan hingga akhir waktu sewa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact -->
        <section id="contact" class="bg-[var(--canvas-light)]">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid gap-8 lg:grid-cols-12 lg:items-start">
                    <div class="lg:col-span-5">
                        <div class="inline-flex items-center gap-2 rounded-full bg-black/5 px-3 py-2">
                            <span class="h-2.5 w-2.5 rounded-full bg-[var(--aloe-10)]"></span>
                            <span class="text-sm font-semibold">Kontak</span>
                        </div>
                        <h2 class="mt-4 text-4xl sm:text-5xl font-medium">Chat via WhatsApp 24/7</h2>
                        <p class="mt-3 text-sm sm:text-base text-black/70">Kirim kebutuhan Anda: tanggal, jumlah penumpang, dan preferensi armada.</p>
                        <div class="mt-6 rounded-2xl border border-[var(--hairline-light)] bg-white p-6">
                            <div class="text-sm font-semibold">Reservasi</div>
                            <p class="mt-2 text-sm text-black/70">Kami akan bantu rekomendasi paket dan ketersediaan armada.</p>
                            <a id="wa-link" class="btn-pill btn-aloe mt-5 w-full" href="https://wa.me/6281234567890" target="_blank" rel="noreferrer">Chat WhatsApp Sekarang</a>
                            <p class="mt-3 text-xs text-black/50">Nomor bantuan: +62 812-3456-7890</p>
                        </div>
                        <div class="mt-4 rounded-2xl border border-[var(--hairline-light)] bg-[var(--canvas-cream)] p-6">
                            <div class="text-sm font-semibold">Informasi</div>
                            <div class="mt-3 space-y-2 text-sm text-black/70">
                                <div>📍 Lokasi: Bali (pool terdekat akan kami informasikan)</div>
                                <div>✉️ Email: info@balicarrental.example</div>
                                <div>☎️ WhatsApp: 0812-3456-7890</div>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-7">
                        <div class="rounded-2xl overflow-hidden border border-[var(--hairline-light)] bg-[var(--canvas-cream)]">
                            <div class="h-72 sm:h-80 md:h-96">
                                <iframe class="w-full h-full" src="https://www.google.com/maps?q=Bali&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-front-layout>
