{{--
    Blade Anonymous Component — Bottom Sheet
    Path : resources/views/components/bottom-sheet.blade.php

    Props:
        title    (string) default "Pilih Aksi"
        subtitle (string) default "Apa yang ingin kamu lakukan?"

    Cara pakai:
        <x-bottom-sheet />
        <x-bottom-sheet title="Opsi File" subtitle="Pilih aksi untuk file ini" />

    Buka dari mana saja (zero server round-trip):
        <button @click="$dispatch('open-bottom-sheet')">Buka</button>

    Tangkap aksi di parent (Livewire / Alpine):
        @bottom-sheet-edit.window="..."
        @bottom-sheet-delete.window="..."
--}}

@props([
    'title'    => 'Pilih Aksi',
    'subtitle' => 'Apa yang ingin kamu lakukan?',
])

{{-- ── Bottom Sheet ── --}}
<div
    x-data="{
        open: false,
        startY: 0,
        dragging: false,
        dragOffset: 0,

        onTouchStart(e) {
            this.startY   = e.touches[0].clientY;
            this.dragging = true;
        },
        onTouchMove(e) {
            if (!this.dragging) return;
            const dy = e.touches[0].clientY - this.startY;
            if (dy > 0) this.dragOffset = dy;
        },
        onTouchEnd(e) {
            this.dragging   = false;
            const dy        = e.changedTouches[0].clientY - this.startY;
            this.dragOffset = 0;
            if (dy > 120) this.open = false;
        },

        toast(msg) {
            this.$dispatch('bs-toast', { message: msg });
        }
    }"
    @open-bottom-sheet.window="open = true"
    @keydown.escape.window="open = false"
>
    {{-- Overlay --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="open = false"
        class="fixed inset-0 z-40 bg-black/60 backdrop-blur-sm"
        style="display:none;"
        aria-hidden="true"
    ></div>

    {{-- Sheet panel --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-[cubic-bezier(0.32,0.72,0,1)] duration-[420ms]"
        x-transition:enter-start="translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-[280ms]"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="translate-y-full"
        :style="dragOffset > 0 ? `transform: translateY(${dragOffset}px)` : ''"
        @touchstart="onTouchStart($event)"
        @touchmove="onTouchMove($event)"
        @touchend="onTouchEnd($event)"
        class="fixed bottom-0 left-0 right-0 z-50 max-w-lg mx-auto
               bg-white border border-zinc-200 rounded-t-3xl
               shadow-2xl shadow-zinc-300/60"
        style="display:none; will-change:transform;"
        role="dialog"
        aria-modal="true"
        aria-label="{{ $title }}"
    >
        {{-- Drag handle --}}
        <div class="flex justify-center pt-4 pb-2">
            <div class="w-10 h-1 rounded-full bg-zinc-300 cursor-grab active:cursor-grabbing"></div>
        </div>

        {{-- Header --}}
        <div class="px-6 pt-2 pb-5 border-b border-zinc-200">
            <h2 class="text-zinc-900 text-lg font-bold tracking-tight">{{ $title }}</h2>
            <p class="text-zinc-400 text-sm mt-0.5">{{ $subtitle }}</p>
        </div>

        {{-- Actions --}}
        <div class="p-3 space-y-1">

            {{-- Edit --}}
            <button
                @click="
                    open = false;
                    toast('✏️ Mode edit diaktifkan');
                    $dispatch('bottom-sheet-edit');
                "
                class="group relative overflow-hidden w-full flex items-center gap-4 px-4 py-4
                       rounded-2xl text-left
                       hover:bg-zinc-100 active:bg-zinc-200
                       transition-all duration-150"
            >
                <div
                    class="flex-shrink-0 w-11 h-11 rounded-xl
                           bg-blue-500/10 border border-blue-500/20
                           flex items-center justify-center
                           group-hover:bg-blue-500/15 group-hover:border-blue-500/30
                           transition-colors duration-150"
                    style="box-shadow:0 0 16px rgba(99,179,237,0.25)"
                >
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                 m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-zinc-800 font-semibold text-sm">Edit</p>
                    <p class="text-zinc-400 text-xs mt-0.5">Ubah informasi item ini</p>
                </div>
                <svg class="w-4 h-4 text-zinc-300
                            group-hover:text-zinc-400 group-hover:translate-x-0.5
                            transition-all duration-150"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Divider --}}
            <div class="h-px mx-4"
                 style="background:linear-gradient(90deg,transparent,rgba(0,0,0,0.06),transparent)">
            </div>

            {{-- Delete --}}
            <button
                @click="
                    if (!confirm('Yakin ingin menghapus item ini?')) return;
                    open = false;
                    toast('🗑️ Item berhasil dihapus');
                    $dispatch('bottom-sheet-delete');
                "
                class="group relative overflow-hidden w-full flex items-center gap-4 px-4 py-4
                       rounded-2xl text-left
                       hover:bg-red-50 active:bg-red-100
                       transition-all duration-150"
            >
                <div
                    class="flex-shrink-0 w-11 h-11 rounded-xl
                           bg-orange-500/10 border border-orange-500/20
                           flex items-center justify-center
                           group-hover:bg-red-500/15 group-hover:border-red-500/30
                           transition-colors duration-150"
                    style="box-shadow:0 0 16px rgba(252,129,74,0.25)"
                >
                    <svg class="w-5 h-5 text-orange-400 group-hover:text-red-400 transition-colors duration-150"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7
                                 m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-orange-400 group-hover:text-red-400 font-semibold text-sm transition-colors duration-150">
                        Hapus
                    </p>
                    <p class="text-zinc-400 text-xs mt-0.5">Tindakan ini tidak dapat dibatalkan</p>
                </div>
                <svg class="w-4 h-4 text-zinc-300
                            group-hover:text-red-400 group-hover:translate-x-0.5
                            transition-all duration-150"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>

        {{-- Cancel --}}
        <div class="px-3 pb-3 pt-1">
            <button
                @click="open = false"
                class="w-full py-4 rounded-2xl font-semibold text-sm text-zinc-500
                       bg-zinc-100 border border-zinc-200
                       hover:bg-zinc-200 hover:text-zinc-700 hover:border-zinc-300
                       active:scale-[0.98] transition-all duration-150"
            >
                Batalkan
            </button>
        </div>

        {{-- iOS safe area --}}
        <div class="h-4 sm:h-0"></div>
    </div>
</div>

{{-- ── Toast (singleton, diletakkan di sini agar portabel) ── --}}
<div
    x-data="{ show: false, message: '' }"
    @bs-toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 2500)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    class="fixed top-6 left-1/2 -translate-x-1/2 z-[60]
           bg-white border border-zinc-200 text-zinc-800 text-sm font-medium
           px-5 py-3 rounded-2xl shadow-lg shadow-zinc-200/80 whitespace-nowrap pointer-events-none"
    style="display:none;"
    x-text="message"
></div>
