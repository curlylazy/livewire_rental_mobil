<?php

use App\Models\PelangganModel;
use App\Models\ProdukModel;
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
    public function dataProduk()
    {
        $data = ProdukModel::with(['subkategori.kategori'])
                ->select('kodeproduk', 'namaproduk', 'harga', 'kodesubkategori')
                ->search($this->katakunci)
                ->paginate(10, pageName: 'produk-page');

        return $data;
    }

    public function selectRow($data)
    {
        $this->katakunci = "";
        $this->dispatch('selectproduk', data: $data);
    }
};

?>

{{-- *** Views --}}
<div>
    <x-partials.modal modalSize="modal-lg" modalId='modalProduk' modalName='Produk'>
        <div wire:loading.class="d-none">
            <div class="row mb-2">
                <div class="col-12 col-lg-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="katakunci" wire:model='katakunci' wire:keydown.enter='$commit' placeholder="">
                        <label for="katakunci">Katakunci</label>
                    </div>
                </div>
            </div>
            @if($this->dataProduk->isEmpty())
                <div>Maaf tidak ada data yang ditemukan</div>
            @else
                <ul class="list-group">
                    @foreach($this->dataProduk as $data)
                        <li class="list-group-item" role="button" wire:click="selectRow('{{ $data }}')">
                            <div class="d-flex align-items-center">
                                <div class="flex-column flex-grow-1">
                                    <div class='fs-6 fw-light'>{{ $data->subkategori->namasubkategori }}</div>
                                    <h6 class='fw-bold mb-1'>{{ $data->namaproduk }}</h6>
                                </div>
                                <div class='fs-6 fw-bold text-warning'>${{ Number::format($data->harga) }}</div>
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
                <div class="m-2">{{ $this->dataProduk->links() }}</div>
            </div>
        </x-slot>
    </x-partials.modal>
</div>

{{-- *** Style --}}
<style>
    #modalProduk {
        z-index: 1060 !important; /* default Bootstrap modal z-index is 1050 */
    }

    .modal-backdrop.modal-backdrop-second {
        z-index: 1059 !important;
    }
</style>
