<flux:field>
    <flux:label>{{ $label ?? 'File' }}</flux:label>

    <flux:input type="file" wire:model="{{ $model }}" />

    <flux:error name="{{ $model }}" />

    @if ($temp)
        <div class="relative mt-2 overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
            <img src="{{ $temp->temporaryUrl() }}" class="w-full h-80 object-cover">
        </div>
    @elseif(!empty($gambar))
        <div class="relative mt-2 overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
            <img src="{{ ImageUtils::getImageThumb($gambar) }}" class="w-full h-80 object-cover">
            <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/70 to-transparent flex gap-2">
                <flux:button size="sm" variant="danger" icon="trash" wire:click="$dispatch('{{ $dispatchDelete }}')">Hapus</flux:button>
                <flux:button size="sm" href="{{ ImageUtils::getImage($gambar) }}" target="_blank" icon="magnifying-glass">Zoom</flux:button>
            </div>
        </div>
    @endif
</flux:field>

