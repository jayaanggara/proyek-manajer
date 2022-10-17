<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProyekType;
class ProyekTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProyekType::create([
            'type_name' => 'Maintenance',
            'type_description' => 'Maintenance Bulanan',
        ]);
        ProyekType::create([
            'type_name' => 'Web Design',
            'type_description' => 'Web Design',
        ]);
        ProyekType::create([
            'type_name' => 'Graphic Design',
            'type_description' => 'Graphic Design',
        ]);
    }
}
