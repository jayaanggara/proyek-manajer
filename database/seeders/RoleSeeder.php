<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'deskripsi' => 'roles admin',
            'status' => '1',
        ]);
        Role::create([
            'name' => 'Proyek Manajer',
            'deskripsi' => 'roles Proyek Manajer',
            'status' => '1',
        ]);
        Role::create([
            'name' => 'Staff',
            'deskripsi' => 'roles staff',
            'status' => '1',
        ]);
        Role::create([
            'name' => 'Client',
            'deskripsi' => 'roles client',
            'status' => '1',
        ]);
    }
}
