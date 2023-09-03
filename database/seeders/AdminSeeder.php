<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\UserModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            "name" => "Süper",
            "surname" => "Admin",
            "email" => "admin@mudafaa.com",
            "password" => Hash::make('123123')
        ]);

        $user = new UserModel();
        $user->name = 'yusuf';
        $user->surname = 'damar';
        $user->phone = '5456110790';
        $user->email = 'yusuf@gmail.com';
        $user->password = "123123";
        $user->save();
    }
}
