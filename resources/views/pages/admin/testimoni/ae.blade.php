<?php

use App\Livewire\Forms\TestimoniForm;
use Flux\Flux;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "Testimoni";
    public $pageName = "testimoni";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public TestimoniForm $form;

    public function mount($id = null)
    {
        if (empty($id)) {
            $this->isEdit = false;
            $this->pageTitle = "Tambah Testimoni";
        } else {
            $this->isEdit = true;
            $this->pageTitle = "Edit Testimoni";
            $this->readData($id);
        }
    }

    public function readData(string $id)
    {
        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->nama;
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
        <flux:breadcrumbs.item href="/admin/testimoni">Testimoni</flux:breadcrumbs.item>
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
                    <flux:label>Nama Lengkap</flux:label>
                    <flux:input wire:model="form.nama" placeholder="Masukkan nama pelanggan..." />
                    <flux:error name="form.nama" />
                </flux:field>

                <flux:field>
                    <flux:label>Alamat / Asal Kota</flux:label>
                    <flux:input wire:model="form.alamat" placeholder="Masukkan kota asal/alamat pelanggan (misal: Jakarta, Surabaya)..." />
                    <flux:error name="form.alamat" />
                </flux:field>

                <flux:field>
                    <flux:label>Isi Testimoni</flux:label>
                    <flux:textarea wire:model="form.isi" placeholder="Masukkan komentar/testimoni pelanggan..." rows="5" />
                    <flux:error name="form.isi" />
                </flux:field>
                
            </div>

            <div class="flex items-center gap-2 justify-start mt-6">
                <flux:button href="{{ url('admin/' . $pageName) }}" icon="arrow-left" variant="outline" wire:navigate></flux:button>
                <flux:button type="submit" icon="check" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </div>
</div>
