<?php

namespace App\Livewire\Forms;

use App\Models\GaleriModel;
use App\Lib\Upload;
use Livewire\Form;
use Livewire\Attributes\Validate;

class GaleriForm extends Form
{
    public $kodegaleri = '';
    public $nama = '';
    public $gambar = '';

    #[Validate('nullable|image|max:1024', onUpdate: false)]
    public $gambarFile;

    public function rules()
    {
        return [
            'nama' => 'required',
        ];
    }

    public function setPost($id)
    {
        if (empty($id)) {
            return;
        }

        $data = GaleriModel::find($id);
        if ($data) {
            $this->kodegaleri = $data->kodegaleri;
            $this->nama = $data->nama;
            $this->gambar = $data->gambar;
        }
    }

    public function prepare()
    {
        // Tempat untuk melakukan pra-proses data sebelum divalidasi
    }

    public function aftervalidated()
    {
        if ($this->gambarFile) {
            $this->gambar = Upload::image($this->gambarFile, $this->gambar, true);
        }
    }

    private function exceptData()
    {
        $arr = ['gambarFile'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $data = GaleriModel::create($this->except($this->exceptData()));

        return $data->kodegaleri;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        GaleriModel::find($this->kodegaleri)->update($this->except($this->exceptData()));

        return $this->kodegaleri;
    }

    public function hapusGambar($kode)
    {
        $data = GaleriModel::find($kode);
        if ($data && !empty($data->gambar)) {
            Upload::deleteImage($data->gambar);
            $data->update(['gambar' => ""]);
        }
    }
}
