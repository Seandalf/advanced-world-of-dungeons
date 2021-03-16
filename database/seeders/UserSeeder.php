<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'           => 'Sean Meakin',
                'username'       => 'sean.meakin',
                'password'       => Hash::make('Kappa9gamma0'),
                'reset_password' => false
            ],[
                'name'           => 'Lisa Waylen',
                'username'       => 'lisa.waylen',
                'password'       => Hash::make('j@zzyPotato55'),
                'reset_password' => true
            ],[
                'name'           => 'Rachael Turner',
                'username'       => 'rachael.turner',
                'password'       => Hash::make('gi@ntBuffalo86'),
                'reset_password' => true
            ],[
                'name'           => 'Nichola Larkins',
                'username'       => 'nichola.larkins',
                'password'       => Hash::make('blu3Pump11'),
                'reset_password' => true
            ],[
                'name'           => 'Marianne Johnstone',
                'username'       => 'marianne.johnstone',
                'password'       => Hash::make('meg@Twist40'),
                'reset_password' => true
            ],
        ]);
    }
}
