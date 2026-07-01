<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\PaketModel;
use Flux\Flux;
use App\Lib\IDateTime;

new class extends Component
{
    use WithPagination;

    public $pageTitle = "Paket Rental";
    public $pageName = "paket";
    public $selectedKode = "";
    public $selectedNama = "";

    #[Url]
    public $katakunci = "";

    public function readData()
    {
        return PaketModel::search($this->katakunci)->paginate(20);
    }

    public function hapus(String $id)
    {
        try
        {
            $data = PaketModel::findOrFail($id);
            $namadata = $data->mobil;
            $data->delete();
            Flux::modal('modalConfirm')->close();

            $this->readData();

            session()->flash('success', "berhasil hapus data $namadata");
        } catch (\Exception $e) {
            $this->dispatch('notif', message: "gagal hapus data : ".$e->getMessage(), icon: "error");
        }
    }

    public function render()
    {
        return $this->view([
            "dataRows" => $this->readData(),
        ])
        ->layout('layouts.admin')
        ->title("$this->pageTitle | ".config('app.webname'));
    }
};

?>

{{-- *** Views --}}
<div>

    <x-partials.loader />

    {{-- *** Header --}}
    <flux:heading size="xl" level="1">{{ $pageTitle }}</flux:heading>
    <flux:breadcrumbs class="mt-2 mb-2">
        <flux:breadcrumbs.item href="/admin/dashboard">Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href="/admin/paket">Paket Rental</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>List</flux:breadcrumbs.item>
    </flux:breadcrumbs>
    <flux:separator variant="subtle" class='mb-3' />

    {{-- *** Search, Add, Back --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
        <div class="flex items-center gap-2">
            <flux:button href="/admin/dashboard" icon="arrow-left" variant="outline" wire:navigate></flux:button>
            <flux:button href="/admin/paket/add" icon="plus" variant="primary" wire:navigate>Tambah</flux:button>
        </div>
        <div class="w-full md:w-100">
            <flux:input.group>
                <flux:input wire:model.live.debounce.300ms="katakunci" placeholder="masukkan katakunci..." icon="magnifying-glass" clearable />
                <flux:button icon="arrow-path" wire:click='readData'></flux:button>
            </flux:input.group>
        </div>
    </div>

    {{-- *** Large Device --}}
    <x-partials.viewlarge>
        <flux:table :paginate="$dataRows">
            <flux:table.columns>
                <flux:table.column>No</flux:table.column>
                <flux:table.column>Mobil</flux:table.column>
                <flux:table.column>Merk</flux:table.column>
                <flux:table.column>Tipe</flux:table.column>
                <flux:table.column>Harga</flux:table.column>
                <flux:table.column>Driver</flux:table.column>
                <flux:table.column>BBM</flux:table.column>
                <flux:table.column>Create</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
                @foreach ($dataRows as $data)
                    <flux:table.row class="hover:cursor-pointer" wire:click="$dispatch('selected-data', { 'data' : {{ $data }} })">
                        <flux:table.cell>{{ $loop->index + 1 }}</flux:table.cell>
                        <flux:table.cell class="font-semibold">{{ $data->mobil }}</flux:table.cell>
                        <flux:table.cell>{{ $data->merk }}</flux:table.cell>
                        <flux:table.cell>{{ $data->tipe_mobil }}</flux:table.cell>
                        <flux:table.cell class="text-zinc-800 dark:text-zinc-200 font-bold">Rp {{ number_format($data->harga, 0, ',', '.') }}</flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="{{ $data->isDriver ? 'green' : 'zinc' }}" inset="top bottom">
                                {{ $data->isDriver ? 'Ya' : 'Tidak' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge color="{{ $data->isFuel ? 'green' : 'zinc' }}" inset="top bottom">
                                {{ $data->isFuel ? 'Ya' : 'Tidak' }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell>{{ IDateTime::formatDate($data->created_at) }}</flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </x-partials.viewlarge>

    {{-- *** Mobile --}}
    <x-partials.viewsmall>
        <div class="grid grid-cols-1 gap-2">
            @foreach ($dataRows as $data)
                <flux:card 
                    size="sm" 
                    class="hover:bg-zinc-50 dark:hover:bg-zinc-700 hover:cursor-pointer"
                    wire:click="$dispatch('selected-data', { 'data' : {{ $data }} })"
                >
                    <div class="flex justify-between items-start gap-2">
                        <flux:heading size="lg">{{ $data->mobil }}</flux:heading>
                        <flux:text class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">Rp {{ number_format($data->harga, 0, ',', '.') }}</flux:text>
                    </div>
                    <div class="flex flex-col gap-1 mt-2 text-xs">
                        <flux:text>Merk: {{ $data->merk }} | Tipe: {{ $data->tipe_mobil }}</flux:text>
                        <div class="flex gap-2 mt-1">
                            <flux:badge size="sm" color="{{ $data->isDriver ? 'green' : 'zinc' }}">Driver: {{ $data->isDriver ? 'Ya' : 'Tidak' }}</flux:badge>
                            <flux:badge size="sm" color="{{ $data->isFuel ? 'green' : 'zinc' }}">BBM: {{ $data->isFuel ? 'Ya' : 'Tidak' }}</flux:badge>
                        </div>
                        <flux:text class="text-zinc-500 mt-1 truncate">Fasilitas: {{ $data->fasilitas ?? '-' }}</flux:text>
                        <flux:text class="text-zinc-400 text-[10px] mt-1">{{ IDateTime::formatDate($data->created_at) }}</flux:text>
                    </div>
                </flux:card>
            @endforeach
        </div>
        <flux:pagination :paginator="$dataRows" />
    </x-partials.viewsmall>

    {{-- *** Modal Selected --}}
    <x-partials.modal-selected>
        <x-slot:pageTitle><span wire:text="pageTitle"></span></x-slot>
        <x-slot:selectedNama><span wire:text="selectedNama"></span></x-slot>
        <div class="flex flex-col gap-2">
            <flux:button wire:click="$dispatch('edit')" icon='pencil'>Edit</flux:button>
            <flux:button variant="danger" wire:click="$dispatch('confirm-delete')" icon='trash'>Delete</flux:button>
        </div>
    </x-partials.modal-selected>

    {{-- *** Modal Confirm : Hapus --}}
    <x-partials.modal-confirm mode="delete">
        <x-slot:selectedNama><span wire:text="selectedNama"></span></x-slot>
        <flux:button variant="danger" x-on:click="$wire.hapus($wire.selectedKode)">Ya</flux:button>
    </x-partials.modal-confirm>
</div>

{{-- *** Script --}}
<script>
    $wire.on('selected-data', (e) => {
        $wire.selectedNama = e.data.mobil;
        $wire.selectedKode = e.data.kodepaket;
        Flux.modal('modalPilihData').show();
    });

    $wire.on('edit', (e) => {
        Livewire.navigate(`/admin/paket/edit/${$wire.selectedKode}`);
    });

    $wire.on('confirm-delete', (e) => {
        Flux.modal('modalPilihData').close();
        Flux.modal('modalConfirm').show();
    });
</script>
