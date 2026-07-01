<?php

namespace App\Livewire\Forms;

use App\Models\PaketModel;
use Livewire\Form;

class PaketForm extends Form
{
    public $kodepaket = '';
    public $tipe_mobil = '';
    public $merk = '';
    public $mobil = '';
    public $harga = '';
    public $isDriver = false;
    public $isFuel = false;
    public $fasilitas = [];

    public function rules()
    {
        return [
            'tipe_mobil' => 'required',
            'merk' => 'required',
            'mobil' => 'required',
            'harga' => 'required|numeric',
            'isDriver' => 'boolean',
            'isFuel' => 'boolean',
            'fasilitas' => 'nullable',
        ];
    }

    public function setPost(string $id)
    {
        if (empty($id)) {
            return;
        }

        $data = PaketModel::find($id);
        $this->kodepaket = $data->kodepaket;
        $this->tipe_mobil = $data->tipe_mobil;
        $this->merk = $data->merk;
        $this->mobil = $data->mobil;
        $this->harga = $data->harga;
        $this->isDriver = (bool)$data->isDriver;
        $this->isFuel = (bool)$data->isFuel;
        $this->fasilitas = json_decode($data->fasilitas);
    }

    public function prepare()
    {
        // Tempat untuk melakukan pra-proses data sebelum divalidasi
    }

    public function aftervalidated()
    {
    }

    private function exceptData()
    {
        $arr = ['fasilitas_id', 'fasilitas_value'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $data = PaketModel::create($this->except($this->exceptData()));
        return $data->kodepaket;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        PaketModel::find($this->kodepaket)->update($this->except($this->exceptData()));
        return $this->kodepaket;
    }
}
