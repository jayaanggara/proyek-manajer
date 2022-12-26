<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Templates;
use SebastianBergmann\Template\Template;

class TemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Templates::create([
            'name' => 'template1',
            'deskripsi' => 'Design Template Export 1',
        ]);
        Templates::create([
            'name' => 'template2',
            'deskripsi' => 'Design Template Export 2',
        ]);
    }
}
