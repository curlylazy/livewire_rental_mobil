{{-- <flux:modal name="{{ $modalId ?? "modalConfirm" }}" class="md:min-w-[25rem]">
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

<flux:modal 
    name="{{ $modalId ?? 'modalError' }}"
    class="md:max-w-[25rem]"
    x-data="{ message: null }" 
    x-on:open-data-modal.window="message = $event.detail.message"
>
    <div class="space-y-6">
        <div class="text-center">
            <flux:heading size="lg">{{ $pageTitle ?? "Error" }}</flux:heading>
            <flux:text class="mt-2">terjadi kesalahan : <span x-text='message'></span></flux:text>
        </div>
        <div class="flex gap-2">
            <flux:spacer />
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>
        </div>
    </div>
</flux:modal>
