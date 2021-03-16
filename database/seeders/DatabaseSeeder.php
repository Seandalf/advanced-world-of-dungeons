<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CharacterClassSeeder::class,
            CharacterSeeder::class,
            AbilitySeeder::class,
            ArmourSeeder::class,
            BackgroundSeeder::class,
            EquipmentSeeder::class,
            RandomGeneratorSeeder::class,
            SkillSeeder::class,
            SpellSeeder::class,
            WeaponSeeder::class
        ]);
    }
}
