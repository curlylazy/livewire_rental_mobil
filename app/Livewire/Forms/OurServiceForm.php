<?php

namespace App\Livewire\Forms;

use App\Models\OurServiceModel;
use Livewire\Form;

class OurServiceForm extends Form
{
    public $kodeour_service = '';
    public $title = '';
    public $description = '';

    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
        ];
    }

    public function setPost($id)
    {
        if (empty($id)) {
            return;
        }

        $data = OurServiceModel::find($id);
        if ($data) {
            $this->kodeour_service = $data->kodeour_service;
            $this->title = $data->title;
            $this->description = $data->description;
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
        $data = OurServiceModel::create($this->except($this->exceptData()));

        return $data->kodeour_service;
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        OurServiceModel::find($this->kodeour_service)->update($this->except($this->exceptData()));

        return $this->kodeour_service;
    }
}
