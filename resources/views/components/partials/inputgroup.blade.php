<div>
    <div class="input-group">
        <div class="form-floating">
            <input type="text" class="form-control pe-none" id="{{ $id }}" wire:model='{{ $model }}' placeholder="" readonly>
            <label for="{{ $id }}">{{ $label }}</label>
        </div>
        <button class="btn btn-outline-secondary" type="button" wire:click='$dispatch("open-modal", { "namamodal" : "{{ $modalName }}" });'><i class="fas fa-search"></i></button>
    </div>
</div>
