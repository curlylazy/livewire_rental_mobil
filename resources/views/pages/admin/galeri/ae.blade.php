<?php

use App\Livewire\Forms\GaleriForm;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;

new class extends Component
{
    use WithFileUploads;

    public $pageTitle = "Galeri";
    public $pageName = "galeri";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public GaleriForm $form;

    public function mount($id = null)
    {
        if (empty($id)) {
            $this->isEdit = false;
            $this->pageTitle = "Tambah Galeri";
        } else {
            $this->isEdit = true;
            $this->pageTitle = "Edit Galeri";
            $this->readData($id);
        }
    }

    public function readData(string $id)
    {
        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->nama;
    }

    public function deleteImage()
    {
        if ($this->isEdit && $this->id) {
            $this->form->hapusGambar($this->id);
            $this->form->gambar = "";
            Flux::toast(heading: 'Berhasil', text: "Gambar berhasil dihapus", variant: 'success');
        }
    }

    public function save()
    {
        try {
            $this->validate();

            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/admin/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            Flux::toast(heading: 'Kesalahan', text: $e->getMessage(), variant: 'danger');
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        Flux::toast(heading: 'Berhasil', text: "berhasil tambah data ".$this->form->nama, variant: 'success');
    }

    public function saveEdit()
    {
        $this->form->update();
        Flux::toast(heading: 'Berhasil', text: "berhasil update data ".$this->form->nama, variant: 'success');
    }

    public function render()
    {
        return $this->view()
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
        <flux:breadcrumbs.item href="/admin/galeri">Galeri</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ ($isEdit) ? "Edit" : "Tambah" }}</flux:breadcrumbs.item>
        @if($isEdit)
            <flux:breadcrumbs.item>{{ $nama }}</flux:breadcrumbs.item>
        @endif
        
    </flux:breadcrumbs>
    <flux:separator variant="subtle" class='mb-3' />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-4">
        <form wire:submit="save">
            <div class="grid grid-cols-1 gap-4">
                <flux:field>
                    <flux:label>Nama Galeri</flux:label>
                    <flux:input wire:model="form.nama" placeholder="Masukkan nama galeri..." />
                    <flux:error name="form.nama" />
                </flux:field>

                <flux:field>
                    <flux:label>Gambar</flux:label>
                    @if($form->gambar)
                        <div class="mb-3 flex items-start gap-3">
                            <img src="{{ asset('storage/image/thumb/' . $form->gambar) }}" alt="Gambar" class="w-32 h-20 object-cover rounded border border-zinc-200">
                            <flux:button variant="danger" size="sm" icon="trash" wire:click="deleteImage" type="button">Hapus Gambar</flux:button>
                        </div>
                    @endif
                    <flux:input type="file" wire:model="form.gambarFile" accept="image/*" />
                    <flux:error name="form.gambarFile" />
                </flux:field>
                
            </div>

            <div class="flex items-center gap-2 justify-start mt-6">
                <flux:button href="{{ url('admin/' . $pageName) }}" icon="arrow-left" variant="outline" wire:navigate></flux:button>
                <flux:button type="submit" icon="check" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </div>
</div>
