<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Lib\Csql;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserModel::create([
            "username" => "admin",
            "nama" => "Admin",
            "akses" => "admin",
            "password" => Hash::make("@12345"),
        ]);

        UserModel::create([
            "username" => "staff",
            "nama" => "Staff ".config('app.webname'),
            "akses" => "staff",
            "password" => Hash::make("@12345"),
        ]);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);

        $user = UserModel::where('username', 'admin')->first();
        $user->assignRole('admin');

        $user = UserModel::where('username', 'staff')->first();
        $user->assignRole('staff');

    }
}
