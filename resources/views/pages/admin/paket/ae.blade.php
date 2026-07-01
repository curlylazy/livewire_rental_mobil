<?php

use App\Livewire\Forms\PaketForm;
use Flux\Flux;
use Livewire\Component;

new class extends Component
{
    public $pageTitle = "Paket Rental";
    public $pageName = "paket";
    public $isEdit = false;
    public $id = "";
    public $nama = "";

    public $titleModalFasilitas = "";
    public $dataFasilitas;
    public $fasilitas_id = "";
    public $fasilitas_value = "";

    public PaketForm $form;

    public function mount($id = null)
    {
        $this->dataFasilitas = collect([]);

        if (empty($id)) {
            $this->isEdit = false;
            $this->pageTitle = "Tambah Paket";
        } else {
            $this->isEdit = true;
            $this->pageTitle = "Edit Paket";
            $this->readData($id);
        }
    }

    public function readData(string $id)
    {
        $this->form->setPost($id);
        $this->id = $id;
        $this->nama = $this->form->mobil;

        // Populate dataFasilitas
        $this->dataFasilitas = collect([]);
        if (is_array($this->form->fasilitas)) {
            foreach ($this->form->fasilitas as $item) {
                if (is_string($item)) {
                    $this->dataFasilitas->push((object)[
                        'id' => uniqid('fas_'),
                        'nama' => $item,
                    ]);
                } elseif (is_object($item) || is_array($item)) {
                    $itemObj = (object)$item;
                    $this->dataFasilitas->push((object)[
                        'id' => $itemObj->id ?? uniqid('fas_'),
                        'nama' => $itemObj->nama ?? ($itemObj->value ?? ''),
                    ]);
                }
            }
        }
    }

    public function save()
    {
        try {
            $this->validate();

            // Sync dataFasilitas to form.fasilitas before storing
            $this->form->fasilitas = $this->dataFasilitas->pluck('nama')->toArray();

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
        Flux::toast(heading: 'Berhasil', text: "berhasil tambah data ".$this->form->mobil, variant: 'success');
    }

    public function saveEdit()
    {
        $this->form->update();
        Flux::toast(heading: 'Berhasil', text: "berhasil update data ".$this->form->mobil, variant: 'success');
    }

    // ** extra
    public function saveFasilitas()
    {
        if(empty($this->fasilitas_id))
        {
            $this->dataFasilitas->push((object)[
                'id' => uniqid('fas_'),
                'nama' => $this->fasilitas_value,
            ]);
        }
        else
        {
            $data = $this->dataFasilitas->firstWhere('id', $this->fasilitas_id);
            if ($data) {
                $data->nama = $this->fasilitas_value;
            }
        }

        // Reset inputs
        $this->fasilitas_id = "";
        $this->fasilitas_value = "";
    }

    public function deleteFasilitas($id)
    {
        $this->dataFasilitas = $this->dataFasilitas->reject(function ($item) use ($id) {
            return $item->id === $id;
        });
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
        <flux:breadcrumbs.item href="/admin/paket">Paket Rental</flux:breadcrumbs.item>
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
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Nama Mobil</flux:label>
                    <flux:input wire:model="form.mobil" placeholder="Masukkan nama mobil (misal: Alphard, Innova)..." />
                    <flux:error name="form.mobil" />
                </flux:field>

                <flux:field>
                    <flux:label>Merk / Brand</flux:label>
                    <flux:input wire:model="form.merk" placeholder="Masukkan merk mobil (misal: Toyota, Daihatsu)..." />
                    <flux:error name="form.merk" />
                </flux:field>

                <flux:field>
                    <flux:label>Tipe Mobil / Kategori</flux:label>
                    <flux:select wire:model="form.tipe_mobil" placeholder="Pilih kategori mobil...">
                        <flux:select.option value="SUV">SUV (Terios, Rush, dll.)</flux:select.option>
                        <flux:select.option value="Mobil Besar/Keluarga">Mobil Besar/Keluarga (APV, HiACE, Innova, dll.)</flux:select.option>
                        <flux:select.option value="Mobil Mewah (Luxury)">Mobil Mewah (Luxury) (Alphard, Vellfire, dll.)</flux:select.option>
                    </flux:select>
                    <flux:error name="form.tipe_mobil" />
                </flux:field>

                <flux:field>
                    <flux:label>Harga Sewa (Rp)</flux:label>
                    <flux:input type="number" wire:model="form.harga" placeholder="Masukkan harga sewa..." />
                    <flux:error name="form.harga" />
                </flux:field>

                <div class="md:col-span-2 flex flex-col gap-2 mt-2">
                    <flux:label>Inklusi Paket</flux:label>
                    <div class="flex gap-4">
                        <flux:checkbox wire:model="form.isDriver" label="Termasuk Driver (Sopir)" />
                        <flux:checkbox wire:model="form.isFuel" label="Termasuk BBM (Bensin)" />
                    </div>
                </div>

                <div class="md:col-span-2 flex flex-col gap-3 mt-2">
                    <div class="flex items-center justify-between">
                        <flux:label class="text-base font-semibold">Fasilitas Paket</flux:label>
                        <flux:button icon="plus" size="sm" variant="primary" wire:click='$dispatch("fasilitas-add")'>Tambah</flux:button>
                    </div>

                    @if ($dataFasilitas && $dataFasilitas->count() > 0)
                        <div class="border border-zinc-200 dark:border-zinc-800 rounded-lg divide-y divide-zinc-200 dark:divide-zinc-800 overflow-hidden bg-white dark:bg-zinc-900">
                            @foreach ($dataFasilitas as $item)
                                <div class="flex items-center justify-between p-3 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                                    <span class="text-sm font-medium text-zinc-800 dark:text-zinc-200">{{ $item->nama }}</span>
                                    <div class="flex items-center gap-2">
                                        <flux:button size="sm" icon="pencil-square" variant="ghost" wire:click='$dispatch("fasilitas-edit", { data: { fasilitas_id: "{{ $item->id }}", fasilitas_value: "{{ $item->nama }}" } })'></flux:button>
                                        <flux:button size="sm" icon="trash" variant="ghost" class="text-red-500 hover:text-red-600 dark:text-red-400" wire:click='deleteFasilitas("{{ $item->id }}")'></flux:button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center p-6 border border-dashed border-zinc-200 dark:border-zinc-800 rounded-lg bg-zinc-50/50 dark:bg-zinc-900/30">
                            <flux:icon name="face-frown" class="w-8 h-8 text-zinc-400 mb-2" />
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">Belum ada fasilitas ditambahkan</span>
                        </div>
                    @endif
                </div>
                
            </div>

            <div class="flex items-center gap-2 justify-start mt-6">
                <flux:button href="{{ url('admin/' . $pageName) }}" icon="arrow-left" variant="outline" wire:navigate></flux:button>
                <flux:button type="submit" icon="check" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </div>

    {{-- *** modal fasilitas --}}
    <flux:modal name="modalFasilitas" class="md:min-w-[25rem] backdrop:backdrop-blur-sm backdrop:bg-zinc-950/60">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg"><span wire:text='titleModalFasilitas'></span></flux:heading>
            </div>
            <flux:field>
                <flux:label>Fasilitas</flux:label>
                <flux:input wire:model="fasilitas_value" placeholder="masukkan fasilitas yang didapatkan" />
            </flux:field>
            <flux:button icon="check" variant="primary" wire:click='$dispatch("fasilitas-save")'>Simpan</flux:button>
        </div>
    </flux:modal>

</div>

<script>
    $wire.on('fasilitas-add', (e) => {
        $wire.titleModalFasilitas = "Tambah Fasilitas";
        $wire.fasilitas_id = "";
        $wire.fasilitas_value = "";
        Flux.modal('modalFasilitas').show();
    });

    $wire.on('fasilitas-edit', (e) => {
        $wire.titleModalFasilitas = "Edit Fasilitas";
        $wire.fasilitas_id = e.data.fasilitas_id;
        $wire.fasilitas_value = e.data.fasilitas_value;
        Flux.modal('modalFasilitas').show();
    });

    $wire.on('fasilitas-save', (e) => {
        $wire.saveFasilitas();
        Flux.modal('modalFasilitas').close();
    });

    $wire.on('edit', (e) => {
        Livewire.navigate(`/admin/our-service/edit/${$wire.selectedKode}`);
    });

</script>
