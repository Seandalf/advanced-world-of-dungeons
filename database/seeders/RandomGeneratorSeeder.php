<?php

namespace Database\Seeders;

use App\Models\RandomGenerator;
use Illuminate\Database\Seeder;

class RandomGeneratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RandomGenerator::insert([
            [
                'type'  => '',
                'value' => ''
            ]
        ]);
    }
}
