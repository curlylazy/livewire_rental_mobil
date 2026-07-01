<?php

namespace App\Livewire\Forms;

use App\Models\TestimoniModel;
use Livewire\Form;

class TestimoniForm extends Form
{
    public $kodetestimoni = '';
    public $nama = '';
    public $alamat = '';
    public $isi = '';

    public function rules()
    {
        return [
            'nama' => 'required',
            'alamat' => 'required',
            'isi' => 'required',
        ];
    }

    public function setPost($id)
    {
        if (empty($id)) {
            return;
        }

        $data = TestimoniModel::find($id);
        if ($data) {
            $this->kodetestimoni = $data->kodetestimoni;
            $this->nama = $data->nama;
            $this->alamat = $data->alamat;
            $this->isi = $data->isi;
        }
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
        $arr = [];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $data = TestimoniModel::create($this->except($this->exceptData()));

        return $data->kodetestimoni;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        TestimoniModel::find($this->kodetestimoni)->update($this->except($this->exceptData()));

        return $this->kodetestimoni;
    }
}
