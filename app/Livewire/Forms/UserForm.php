<?php

namespace App\Livewire\Forms;

use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class UserForm extends Form
{
    public $id;
    public $username = '';
    public $nama = '';
    public $password = '';
    public $password_old = '';
    public $akses = '';

    public function rules()
    {
        return [
            'username' => 'required',
            'nama' => 'required',
            'akses' => 'required',
        ];
    }

    public function setPost($id)
    {
        if(empty($id))
            return;

        $data = UserModel::find($id);
        $this->id = $data->id;
        $this->username = $data->username;
        $this->nama = $data->nama;
        $this->password_old = $data->password;
    }

    public function prepare()
    {
    }

    public function aftervalidated()
    {
        $this->password = (!empty($this->password)) ? Hash::make($this->password) : $this->password_old;
    }

    private function exceptData()
    {
        $arr = ['password_old'];
        return $arr;
    }

    public function store()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $user = UserModel::create($this->except($this->exceptData()));

        // *** set role
        $user->assignRole($this->akses);
    }

    public function update()
    {
        $this->prepare();
        $this->validate();
        $this->aftervalidated();
        $user = UserModel::find($this->kodeuser)->update($this->except($this->exceptData()));

        // *** set role
        // $user = UserModel::find($this->kodeuser);
        // $user->assignRole($this->akses);
    }

}
