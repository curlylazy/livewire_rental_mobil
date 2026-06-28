<?php

use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $label = "";
    public $dispatchDelete = "";
    public $model = "";

    #[Reactive]
    public $temp = "", $gambar = "";
};

?>

{{-- *** Views --}}
<div>
    <label for="{{ $label }}" class="form-label">{{ $label ?? 'File' }}</label>
    <input class="form-control" type="file" id="{{ $label }}" wire:model='{{ $model }}' />
    @if ($temp)
        <img src="{{ $temp->temporaryUrl() ?? '' }}" style="width: 100%; height: 400px; object-fit: cover;" class="rounded mt-2">
    @elseif(!empty($gambar))
        <div class="position-relative">
            <img src="{{ ImageUtils::getImageThumb($gambar) }}" style="width: 100%; height: 400px; object-fit: cover;" class="rounded mt-2">
            <div class="position-absolute bottom-0 start-0 p-3">
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-danger text-white" wire:click='$dispatch("{{ $dispatchDelete }}")'><i class="fas fa-trash"></i> Hapus</button>
                    <a href="{{ ImageUtils::getImage($gambar) }}" target="_blank" class="btn btn-sm btn-primary text-white"><i class="fa-solid fa-magnifying-glass"></i> Zoom</a>
                </div>
            </div>
        </div>
    @endif
</div>
