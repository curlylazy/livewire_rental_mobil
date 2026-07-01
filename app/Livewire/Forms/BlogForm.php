<?php

namespace App\Livewire\Forms;

use App\Lib\Upload;
use App\Models\BlogModel;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Form;

class BlogForm extends Form
{
    // *** onUpdate = tidak melakukan validasi otomatis saat ada request masuk, ex upload image
    #[Validate('nullable|image|max:1024', onUpdate: false)] // 1MB Max
    public $gambarFile;

    public $kodeblog = '';
    public $judul = '';
    public $isi = '';
    public $seoblog = '';
    public $gambar = '';

    // ** bantuan

    public function rules()
    {
        return [
            'isi' => 'required',
            'judul' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = BlogModel::find($id);
        $this->kodeblog = $data->kodeblog;
        $this->judul = $data->judul;
        $this->isi = $data->isi;
        $this->seoblog = $data->seoblog;
        $this->gambar =$data->gambar;
    }

    public function prepare()
    {
        $this->seoblog = Str::slug($this->judul);
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

        if($this->gambarFile)
            $this->gambar = Upload::image($this->gambarFile, $this->gambar, true);

        $data = BlogModel::create($this->except($this->exceptData()));
        $kodeblog = $data->kodeblog;
        return $kodeblog;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();

        BlogModel::find($this->kodeblog)->update($this->except($this->exceptData()));
    }

    public function hapusGambar($kode)
    {
        $data = BlogModel::find($kode);
        Upload::deleteImage($data->gambarblog);
        $data->update(['gambarblog' => ""]);
    }
}
