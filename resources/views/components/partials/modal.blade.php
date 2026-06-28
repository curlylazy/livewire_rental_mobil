<div class="modal fade" id="{{ $modalId }}" tabindex="-1" aria-labelledby="{{ $modalId }}DataLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered {{ $modalSize ?? '' }}">
        <div class="modal-content">

            @if(!empty($modalName))
                <div class="modal-header">
                    <h5 class="modal-title" id="{{ $modalId }}Label">{{ $modalName }}</h5>
                    <button type="button" class="btn-close" data-coreui-dismiss="modal" data-coreui-toggle="modal"></button>
                </div>
            @endif

            <div class="modal-body">
                {{ $slot }}
            </div>

            @if (!empty($modalFooter))
                {!! $modalFooter !!}
            @endif

        </div>
    </div>
</div>
