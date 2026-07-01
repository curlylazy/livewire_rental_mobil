<?php

use App\Livewire\Forms\OurServiceForm;
use Flux\Flux;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "Our Service";
    public $pageName = "our-service";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public OurServiceForm $form;

    public function mount($id = null)
    {
        if (empty($id)) {
            $this->isEdit = false;
            $this->pageTitle = "Tambah Service";
        } else {
            $this->isEdit = true;
            $this->pageTitle = "Edit Service";
            $this->readData($id);
        }
    }

    public function readData(string $id)
    {
        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->title;
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
        Flux::toast(heading: 'Berhasil', text: "berhasil tambah data ".$this->form->title, variant: 'success');
    }

    public function saveEdit()
    {
        $this->form->update();
        Flux::toast(heading: 'Berhasil', text: "berhasil update data ".$this->form->title, variant: 'success');
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
        <flux:breadcrumbs.item href="/admin/our-service">Our Service</flux:breadcrumbs.item>
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
                    <flux:label>Title</flux:label>
                    <flux:input wire:model="form.title" placeholder="Masukkan judul layanan..." />
                    <flux:error name="form.title" />
                </flux:field>

                <flux:field>
                    <flux:label>Description</flux:label>
                    <flux:textarea wire:model="form.description" placeholder="Masukkan deskripsi layanan..." rows="5" />
                    <flux:error name="form.description" />
                </flux:field>
                
            </div>

            <div class="flex items-center gap-2 justify-start mt-6">
                <flux:button href="{{ url('admin/' . $pageName) }}" icon="arrow-left" variant="outline" wire:navigate></flux:navigate>
                <flux:button type="submit" icon="check" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </div>
</div>
