{{-- Original Code (Backup)
<div
    wire:loading.flex
    class="fixed inset-0 z-50 items-center justify-center bg-black/60 backdrop-blur-sm"
>
    <div class="flex flex-col items-center gap-3 rounded-2xl border border-gray-100 bg-white px-10 py-7 shadow-lg">
        <svg
            class="h-10 w-10 animate-spin text-blue-500"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
        >
            <circle
                class="opacity-20"
                cx="12" cy="12" r="10"
                stroke="currentColor"
                stroke-width="4"
            />
            <path
                class="opacity-80"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"
            />
        </svg>
        <div class="flex flex-col items-center gap-1">
            <span class="text-sm font-semibold text-gray-700">Memuat data</span>
            <span class="text-xs text-gray-400">Mohon tunggu sebentar</span>
        </div>
    </div>
</div>
--}}

{{-- Refactored Code using Flux UI --}}
<div
    wire:loading.flex
    class="fixed inset-0 z-50 items-center justify-center bg-black/60 backdrop-blur-sm"
>
    <flux:card class="flex flex-col items-center gap-3 px-10 py-7 shadow-lg">
        {{-- Spinner --}}
        <flux:icon name="loading" class="size-10 text-blue-500" />
        <div class="flex flex-col items-center gap-1">
            <flux:text variant="strong" class="font-semibold">Memuat data</flux:text>
            <flux:text size="sm" variant="subtle">Mohon tunggu sebentar</flux:text>
        </div>
    </flux:card>
</div>
