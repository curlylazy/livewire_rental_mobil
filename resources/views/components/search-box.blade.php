<?php

use App\Models\AkunModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Attributes\Modelable;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Illuminate\Support\Str;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";
    public $title;
    public $label;
    public $value;
    public $dataLabel;
    public $prefix;

    #[Modelable]
    public $dataValue;

    #[Reactive]
    public $dataRows;

    public function mount()
    {
        $this->prefix = Str::slug($this->title);
    }
};

?>

{{-- *** Views --}}
<div>
    <div class="col-12 col-md-12">
        <div class="input-group">
            <div class="form-floating">
                <input type="hidden" wire:model='dataValue' />
                <input type="text" class="form-control pe-none" id="{{ Str::slug($title) }}" wire:model='dataLabel' placeholder="" readonly>
                <label for="{{ Str::slug($title) }}">{{ $title }}</label>
            </div>
            <button x-cloak x-show="$wire.dataLabel != ''" class="btn btn-outline-danger" type="button" wire:click="$js.resetData"><i class="fas fa-close"></i></button>
            <button class="btn btn-outline-secondary" type="button" wire:click="$dispatch('open-modal', { namamodal: 'modal-{{ Str::slug($title) }}' })"><i class="fas fa-search"></i></button>
        </div>
    </div>

    @teleport('body')
        <x-partials.modal modalId='modal-{{ $prefix }}' modalName='{{ $title }}'>
            <div>
                <div x-data="{
                    allRows: $wire.$entangle('dataRows'),
                    searchQuery: '',
                    get filteredRows() {
                        const rows = this.allRows ?? {}

                        if (this.searchQuery === '') {
                            return rows;
                        }

                        const filtered = {};
                        for (const [id, name] of Object.entries(rows)) {
                            if (name.toLowerCase().includes(this.searchQuery.toLowerCase())) {
                                filtered[id] = name;
                            }
                        }
                        return filtered;
                    }
                }">
                    <div class="mb-2">
                        <input class="form-control" x-model='searchQuery' placeholder="masukkan katakunci pencarian.." />
                    </div>

                    <div class='scroll-box'>
                        <ul class="list-group">
                            <template x-for="(name, id) in filteredRows" :key="id">
                                <li class="list-group-item" role="button" x-text="name" x-on:click="$wire.dispatch('modal-searchbox-setdata', { dataValue: id, dataLabel: name })"></li>
                            </template>
                        </ul>
                    </div>

                    <div x-show="Object.keys(filteredRows).length === 0 && searchQuery !== ''">
                        <p>Tidak ada data yang ditemukan.</p>
                    </div>
                </div>
            </div>
        </x-partials.modal>
    @endteleport

</div>

{{-- *** Script --}}
<script>

    $wire.on('modal-searchbox-setdata', (e) => {
        $wire.dataValue = e.dataValue;
        $wire.dataLabel = e.dataLabel;

        // $wire.$set('dataValue', e.dataValue);
        // $wire.$set('dataLabel', e.dataLabel);

        console.log(`dataValue : ${$wire.dataValue} - dataLabel : ${$wire.dataLabel}`);

        $wire.dispatch('selected', { data: e.dataValue });
        $wire.dispatch('close-modal', { namamodal : `modal-${$wire.prefix}` });
    });

    this.$js('resetData', () => {
        $wire.dataValue = "";
        $wire.dataLabel = "";
        $wire.dispatch('reset');
    });

</script>
