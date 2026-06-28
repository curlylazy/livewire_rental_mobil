{{-- <dialog id="{{ $modalId ?? 'modalPilihData' }}" class="modal">
    <div class="modal-box text-center">
        <form method="dialog">
            <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
        </form>
        <h4 class="text-lg font-bold">{{ $pageTitle }}</h4>
        @if(!empty($selectedNama))
            <h3 class="text-2xl pt-1 font-bold">{{ $selectedNama }}</h3>
        @endif
        {{ $slot }}
    </div>
</dialog> --}}

<flux:modal name="{{ $modalId ?? 'modalPilihData' }}" class="md:min-w-[25rem] backdrop:backdrop-blur-sm backdrop:bg-zinc-950/60">
    <div class="space-y-6">
        <div class="text-center">
            <flux:heading size="lg">{{ $pageTitle }}</flux:heading>
            @if(!empty($selectedNama))
                <flux:text class="mt-2 text-2xl font-bold">{{ $selectedNama }}</flux:text>
            @endif
        </div>
        {{ $slot }}
    </div>
</flux:modal>
