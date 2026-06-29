<?php

use App\Models\PaketModel;
use App\Models\OurServiceModel;
use App\Models\GaleriModel;
use App\Models\TestimoniModel;
use Illuminate\Support\Str;
use Livewire\Component;

new class extends Component
{

    public $pageTitle = "Beranda";
    public $jmlPaket = 0;
    public $jmlLayanan = 0;
    public $jmlGaleri = 0;
    public $jmlTestimoni = 0;
    public $recentTestimonials;

    public function mount()
    {
        $this->jmlPaket = PaketModel::count();
        $this->jmlLayanan = OurServiceModel::count();
        $this->jmlGaleri = GaleriModel::count();
        $this->jmlTestimoni = TestimoniModel::count();
        $this->recentTestimonials = TestimoniModel::orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.admin')
            ->title($this->pageTitle." - ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div class="space-y-8">
    <x-partials.loader />

    @php
        $hour = date('H');
        $greeting = ($hour < 12) ? 'Selamat Pagi' : (($hour < 15) ? 'Selamat Siang' : (($hour < 18) ? 'Selamat Sore' : 'Selamat Malam'));
    @endphp

    <!-- Header / Greeting Card -->
    <div class="relative overflow-hidden bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-xl p-8 md:p-5 shadow-sm">
        <div>
            <h1 class="text-3xl md:text-2xl font-extrabold tracking-tight text-slate-900 dark:text-white">{{ $greeting }}, {{ Auth::user()->namauser ?? 'User' }}!</h1>
            <p class="mt-2 text-slate-500 dark:text-zinc-400 text-base font-medium max-w-xl">
                Selamat datang kembali di panel admin {{ config('app.webname') }}. Berikut adalah ringkasan menu cepat dan performa sistem Anda hari ini.
            </p>
        </div>
    </div>

    <!-- Quick Menu / Stats Cards -->
    <div class="space-y-4">
        <h2 class="text-xl font-bold text-slate-800 dark:text-zinc-100 flex items-center gap-2">
            <flux:icon name="bolt" class="size-6 text-amber-500" />
            <span>Menu Cepat</span>
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Paket Armada -->
            <x-partials.quick-menu 
                href="#" 
                icon="briefcase" 
                color="indigo" 
                title="Paket Armada" 
                count="{{ $jmlPaket }}" 
            />

            <!-- Layanan -->
            <x-partials.quick-menu
                href="#" 
                icon="bolt" 
                color="emerald" 
                title="Layanan" 
                count="{{ $jmlLayanan }}" 
            />

            <!-- Galeri -->
            <x-partials.quick-menu
                href="#" 
                icon="photo" 
                color="pink" 
                title="Galeri" 
                count="{{ $jmlGaleri }}" 
            />

            <!-- Testimoni -->
            <x-partials.quick-menu
                href="#" 
                icon="chat-bubble-left-right" 
                color="amber" 
                title="Testimoni" 
                count="{{ $jmlTestimoni }}" 
            />
        </div>
    </div>

    <!-- Recent Testimonials Section -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-800 dark:text-zinc-100 flex items-center gap-2">
                <flux:icon name="chat-bubble-left-right" class="size-6 text-amber-500" />
                <span>Testimoni Terbaru</span>
            </h2>
            <flux:button href="#" variant="ghost" size="sm" icon-trailing="chevron-right" wire:navigate>
                Lihat Semua
            </flux:button>
        </div>

        <div class="bg-white dark:bg-zinc-900 border border-slate-200 dark:border-zinc-800 rounded-xl p-4 shadow-sm">
            <flux:table>
                <flux:table.columns>
                    <flux:table.column>Nama</flux:table.column>
                    <flux:table.column>Alamat</flux:table.column>
                    <flux:table.column>Testimoni</flux:table.column>
                    <flux:table.column>Tanggal</flux:table.column>
                </flux:table.columns>

                <flux:table.rows>
                    @forelse ($recentTestimonials as $testimoni)
                        <flux:table.row wire:key="testimoni-{{ $testimoni->kodetestimoni }}">
                            <flux:table.cell class="font-medium text-slate-900 dark:text-white">
                                {{ $testimoni->nama }}
                            </flux:table.cell>
                            <flux:table.cell>
                                {{ $testimoni->alamat }}
                            </flux:table.cell>
                            <flux:table.cell>
                                {{ Str::limit($testimoni->isi, 60) }}
                            </flux:table.cell>
                            <flux:table.cell>
                                {{ $testimoni->created_at ? $testimoni->created_at->format('d M Y') : '-' }}
                            </flux:table.cell>
                        </flux:table.row>
                    @empty
                        <flux:table.row>
                            <flux:table.cell colspan="4" class="text-center text-zinc-500 dark:text-zinc-400 py-4">
                                Belum ada data testimoni.
                            </flux:table.cell>
                        </flux:table.row>
                    @endforelse
                </flux:table.rows>
            </flux:table>
        </div>
    </div>
</div>
