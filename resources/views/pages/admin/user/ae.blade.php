<?php

use App\Livewire\Forms\UserForm;
use Flux\Flux;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "User";
    public $pageName = "user";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public UserForm $form;

    public function mount($id = null)
    {
        if (empty($id)) {
            $this->isEdit = false;
            $this->pageTitle = "Tambah User";
        } else {
            $this->isEdit = true;
            $this->pageTitle = "Edit User";
            $this->readData($id);
        }
    }

    public function readData(string $id)
    {
        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->namauser;
    }

    public function save()
    {
        try {
            $this->validate();

            ($this->isEdit) ? $this->saveEdit() : $this->saveAdd();

            $this->redirect("/$this->pageName", navigate: true);

        } catch (\Exception $e) {
            Flux::toast(heading: 'Kesalahan', text: $e->getMessage(), variant: 'danger');
            return;
        }
    }

    public function saveAdd()
    {
        $this->form->store();
        Flux::toast(heading: 'Berhasil', text: "berhasil tambah data ".$this->form->namauser, variant: 'success');
    }

    public function saveEdit()
    {
        $this->form->update();
        Flux::toast(heading: 'Berhasil', text: "berhasil update data ".$this->form->namauser, variant: 'success');
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
        <flux:breadcrumbs.item href='{{ url("/") }}'>Dashboard</flux:breadcrumbs.item>
        <flux:breadcrumbs.item href='{{ url("/$pageName") }}'>User</flux:breadcrumbs.item>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <flux:field>
                    <flux:label>Username</flux:label>
                    <flux:input wire:model="form.username" icon="user" placeholder="Masukkan username..." />
                    <flux:error name="form.username" />
                </flux:field>

                <flux:field>
                    <flux:label>Nama Lengkap</flux:label>
                    <flux:input wire:model="form.namauser" placeholder="Masukkan nama lengkap..." />
                    <flux:error name="form.namauser" />
                </flux:field>

                <flux:field class="md:col-span-2">
                    <flux:label>Akses</flux:label>
                    <flux:select wire:model="form.akses" placeholder="Pilih akses...">
                        <flux:select.option value="admin">Admin</flux:select.option>
                        <flux:select.option value="staff">Staff</flux:select.option>
                    </flux:select>
                    <flux:error name="form.akses" />
                </flux:field>

                <flux:field class="md:col-span-2">
                    <flux:label>Password</flux:label>
                    <flux:input type="password" wire:model="form.password" icon="key" placeholder="{{ $isEdit ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan password...' }}" />
                    <flux:error name="form.password" />
                </flux:field>
                
            </div>

            <div class="flex items-center gap-2 justify-start mt-6">
                <flux:button href="{{ url($pageName) }}" icon="arrow-left" variant="outline" wire:navigate></flux:button>
                <flux:button type="submit" icon="check" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </div>
</div>
