<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::insert([
            [
                'name'        => '',
                'description' => '',
                'cost'        => '',
                'uses'        => ''
            ]
        ]);
    }
}
