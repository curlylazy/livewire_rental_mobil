{{-- <flux:modal name="{{ $modalId ?? " modalConfirm" }}" class="md:min-w-[25rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $pageTitle ?? "Konfirmasi" }}</flux:heading>
            @if($mode == "delete")
            <flux:text class="mt-2">Data dengan nama <b>{{ $selectedNama ?? "" }}</b>, akan dihapus dari sistem, lanjutkan progres ?</flux:text>
            @endif
        </div>
        {{ $slot }}
    </div>
</flux:modal> --}}

<flux:modal name="{{ $modalId ?? 'modalConfirm' }}" class="w-5/6 md:max-w-[25rem] backdrop:backdrop-blur-sm backdrop:bg-zinc-950/60">
    <div class="space-y-6">
        <div class="text-center">
            <flux:heading size="lg">{{ $pageTitle ?? "Konfirmasi Hapus" }}</flux:heading>
            @if($mode == "delete")
                <flux:text class="mt-2">Data dengan nama <b>{{ $selectedNama ?? "" }}</b>, akan dihapus dari sistem, lanjutkan progres ?</flux:text>
            @endif
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
            {{ $slot }}
        </div>
    </div>
</flux:modal>