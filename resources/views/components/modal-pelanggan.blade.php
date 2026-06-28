<?php

use App\Models\PelangganModel;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Reactive;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $katakunci = "";

    #[Reactive]
    public $tipe = "";

    #[Computed()]
    public function dataPelanggan()
    {
        $data = PelangganModel::search($this->katakunci)->paginate(10, pageName: 'pelanggan-page');
        return $data;
    }

    public function selectRow($data)
    {
        $this->katakunci = "";
        $this->dispatch('selectpelanggan', data: $data);
    }
};

?>

{{-- ***Views --}}
<div>
    <flux:modal name="modalPelanggan" class="md:min-w-[30rem] backdrop:backdrop-blur-sm backdrop:bg-zinc-950/60">
        <div class="space-y-6">
            <div class="text-start">
                <flux:heading size="lg">Daftar Pelanggan</flux:heading>
            </div>
            <div class="w-full">
                <flux:input wire:model.live.debounce.300ms="katakunci" placeholder="masukkan katakunci..." icon="magnifying-glass" clearable />
            </div>
            <div class="grid grid-cols-1 gap-2">
                @foreach ($this->dataPelanggan as $data)
                    <flux:card 
                        wire:key="card-{{ $data->kodepelanggan }}"
                        size="sm" 
                        class="hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:cursor-pointer p-2"
                        wire:click="selectRow('{{ $data }}')"
                    >
                        <div class="flex flex-col gap-1">
                            <flux:heading>{{ $data->namapelanggan }}</flux:heading>
                            <flux:text>{{ $data->namaperusahaan }}</flux:text>
                        </div>
                    </flux:card>
                @endforeach
            </div>
        </div>
    </flux:modal>
    
    {{-- <x-partials.modal modalId='modalPelanggan' modalName='Pelanggan'>
        <div wire:loading.class="d-none">
            <div class="mb-2">
                <input class="form-control" wire:model='katakunci' placeholder="masukkan katakunci pencarian.." wire:keydown.enter='$commit'/>
            </div>
            @if($this->dataPelanggan->isEmpty())
                <div>Maaf tidak ada data yang ditemukan</div>
            @else
                <ul class="list-group">
                    @foreach($this->dataPelanggan as $data)
                        <li class="list-group-item" role="button" wire:click="selectRow('{{ $data }}')">
                            <div class="d-flex flex-column">
                                <div class='fw-normal'><i class="fas fa-user fa-xs text-primary"></i> {{ $data->userpelanggan }}</div>
                                <h6 class='fw-bold mb-0'>{{ $data->namapelanggan }}</h6>
                                <div class='fs-6 fw-light'>{{ $data->alamatpelanggan }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div wire:loading.inline>
            <div class="text-center h5"><i class="fas fa-circle-notch fa-spin"></i> Memuat Halaman</div>
        </div>

        <x-slot:modalFooter>
            <div class="modal-footer d-block">
                <div class="m-2">{{ $this->dataPelanggan->links() }}</div>
            </div>
        </x-slot>
    </x-partials.modal> --}}
</div>

{{-- ***Style --}}
<style>
    #modalPelanggan {
        z-index: 1060 !important; /* default Bootstrap modal z-index is 1050 */
    }

    .modal-backdrop.modal-backdrop-second {
        z-index: 1059 !important;
    }
</style>
