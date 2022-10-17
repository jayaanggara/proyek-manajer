<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        user::create([
            'name' => 'Admin',
            'email' => 'jayaanggara112@gmail.com',
            'password' => Hash::make('admin123'),
            'roles_id' => '1'
        ]);
        user::create([
            'name' => 'Proyek Manajer',
            'email' => 'proyekmanajer@gmail.com',
            'password' => Hash::make('admin123'),
            'roles_id' => '2'
        ]);
        user::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('admin123'),
            'roles_id' => '3'
        ]);
        user::create([
            'name' => 'Client',
            'email' => 'client@gmail.com',
            'password' => Hash::make('admin123'),
            'roles_id' => '4'
        ]);
    }
}
