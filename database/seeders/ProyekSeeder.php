<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyek;
class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Proyek1 = Proyek::create([
            'project_name' => 'Onvition',
            'project_description' => 'Maintenance Bulanan',
            'logo' => 'dasdas-220917-103020.png',
            'status' => 'Aktif',
            'user' => '1',
            'client' => '4',
            'start_date' => '2022-09-30',
            'end_date' => '2022-09-30',
            'site' => 'https://onvition.com',
            'company_name' => 'Mous Media',
            'template_id' => '1',
        ]);
        $Proyek1->getType()->sync([1]);

        $Proyek2 = Proyek::create([
            'project_name' => 'Mousmedia',
            'project_description' => 'Maintenance Bulanan',
            'logo' => 'dasdas-220917-103020.png',
            'status' => 'Pending',
            'user' => '2',
            'client' => '4',
            'start_date' => '2022-09-30',
            'end_date' => '2022-09-30',
            'site' => 'https://onvition.com',
            'company_name' => 'Mous Media',
            'template_id' => '1',
        ]);
        $Proyek2->getType()->sync([1]);

        $Proyek3 = Proyek::create([
            'project_name' => 'Zacrash',
            'project_description' => 'Maintenance Bulanan',
            'logo' => 'dasdas-220917-103020.png',
            'status' => 'complete',
            'user' => '2',
            'client' => '4',
            'start_date' => '2022-09-30',
            'end_date' => '2022-09-30',
            'site' => 'https://onvition.com',
            'company_name' => 'Mous Media',
            'template_id' => '2',
        ]);
        $Proyek3->getType()->sync([1]);
    }
}
