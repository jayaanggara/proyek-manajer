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
        ]);
        Role::create([
            'name' => 'Proyek Manajer',
            'deskripsi' => 'roles Proyek Manajer',
        ]);
        Role::create([
            'name' => 'Staff',
            'deskripsi' => 'roles staff',
        ]);
        Role::create([
            'name' => 'Client',
            'deskripsi' => 'roles client',
        ]);
    }
}
