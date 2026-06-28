<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public bool $isOpen = false;

    /**
     * Buka sheet dari luar: $dispatch('open-bottom-sheet')
     */
    #[On('open-bottom-sheet')]
    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
    }

    public function edit(): void
    {
        $this->isOpen = false;
        // $this->dispatch('item-edited');
        session()->flash('message', '✏️ Mode edit diaktifkan.');
    }

    public function delete(): void
    {
        $this->isOpen = false;
        // YourModel::find($this->itemId)->delete();
        session()->flash('message', '🗑️ Item berhasil dihapus.');
    }
}; ?>

<div
    x-data="{
        open: @entangle('isOpen').live,
        startY: 0,
        dragging: false,
        dragOffset: 0,
        onTouchStart(e) { this.startY = e.touches[0].clientY; this.dragging = true; },
        onTouchMove(e) {
            if (!this.dragging) return;
            const dy = e.touches[0].clientY - this.startY;
            if (dy > 0) this.dragOffset = dy;
        },
        onTouchEnd(e) {
            this.dragging = false;
            const dy = e.changedTouches[0].clientY - this.startY;
            this.dragOffset = 0;
            if (dy > 120) this.open = false;
        }
    }"
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

    {{-- Sheet --}}
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
               bg-zinc-900 border border-zinc-800/80 rounded-t-3xl
               shadow-2xl shadow-black/60"
        style="display:none; will-change:transform;"
        role="dialog"
        aria-modal="true"
        aria-label="Pilih aksi"
    >
        {{-- Drag Handle --}}
        <div class="flex justify-center pt-4 pb-2">
            <div class="w-10 h-1 rounded-full bg-zinc-700 cursor-grab active:cursor-grabbing"></div>
        </div>

        {{-- Header --}}
        <div class="px-6 pt-2 pb-5 border-b border-zinc-800/60">
            <h2 class="text-white text-lg font-bold tracking-tight">Pilih Aksi</h2>
            <p class="text-zinc-500 text-sm mt-0.5">Apa yang ingin kamu lakukan?</p>
        </div>

        {{-- Actions --}}
        <div class="p-3 space-y-1">

            {{-- Edit --}}
            <button
                wire:click="edit"
                wire:loading.attr="disabled"
                class="group relative overflow-hidden w-full flex items-center gap-4 px-4 py-4
                       rounded-2xl text-left hover:bg-zinc-800/70 active:bg-zinc-800
                       transition-all duration-150 disabled:opacity-50"
            >
                <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-blue-500/10 border border-blue-500/20
                            flex items-center justify-center
                            group-hover:bg-blue-500/15 group-hover:border-blue-500/30
                            transition-colors duration-150"
                     style="box-shadow:0 0 16px rgba(99,179,237,0.25)">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5
                                 m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-white font-semibold text-sm">Edit</p>
                    <p class="text-zinc-500 text-xs mt-0.5">Ubah informasi item ini</p>
                </div>
                <span wire:loading wire:target="edit">
                    <svg class="w-4 h-4 text-zinc-400 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                </span>
                <svg wire:loading.remove wire:target="edit"
                     class="w-4 h-4 text-zinc-600 group-hover:text-zinc-400 group-hover:translate-x-0.5 transition-all duration-150"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

            {{-- Divider --}}
            <div class="h-px mx-4" style="background:linear-gradient(90deg,transparent,rgba(255,255,255,0.07),transparent)"></div>

            {{-- Delete --}}
            <button
                wire:click="delete"
                wire:loading.attr="disabled"
                wire:confirm="Yakin ingin menghapus item ini?"
                class="group relative overflow-hidden w-full flex items-center gap-4 px-4 py-4
                       rounded-2xl text-left hover:bg-red-950/30 active:bg-red-950/40
                       transition-all duration-150 disabled:opacity-50"
            >
                <div class="flex-shrink-0 w-11 h-11 rounded-xl bg-orange-500/10 border border-orange-500/20
                            flex items-center justify-center
                            group-hover:bg-red-500/15 group-hover:border-red-500/30
                            transition-colors duration-150"
                     style="box-shadow:0 0 16px rgba(252,129,74,0.25)">
                    <svg class="w-5 h-5 text-orange-400 group-hover:text-red-400 transition-colors duration-150"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7
                                 m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-orange-400 group-hover:text-red-400 font-semibold text-sm transition-colors duration-150">Hapus</p>
                    <p class="text-zinc-500 text-xs mt-0.5">Tindakan ini tidak dapat dibatalkan</p>
                </div>
                <span wire:loading wire:target="delete">
                    <svg class="w-4 h-4 text-red-400 animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                </span>
                <svg wire:loading.remove wire:target="delete"
                     class="w-4 h-4 text-zinc-600 group-hover:text-red-500/60 group-hover:translate-x-0.5 transition-all duration-150"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>

        </div>

        {{-- Cancel --}}
        <div class="px-3 pb-3 pt-1">
            <button
                @click="open = false"
                class="w-full py-4 rounded-2xl font-semibold text-sm text-zinc-400
                       bg-zinc-800/60 border border-zinc-700/50
                       hover:bg-zinc-800 hover:text-zinc-200 hover:border-zinc-600/50
                       active:scale-[0.98] transition-all duration-150"
            >
                Batalkan
            </button>
        </div>

        <div class="h-4 sm:h-0"></div>
    </div>

    {{-- Flash message --}}
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 2500)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="fixed top-6 left-1/2 -translate-x-1/2 z-[60]
                   bg-zinc-800 border border-zinc-700 text-white text-sm font-medium
                   px-5 py-3 rounded-2xl shadow-xl whitespace-nowrap"
        >
            {{ session('message') }}
        </div>
    @endif
</div>
