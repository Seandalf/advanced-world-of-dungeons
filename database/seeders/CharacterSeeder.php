<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\CharacterClass;
use App\Models\User;
use Illuminate\Database\Seeder;
use PhpParser\Builder\Class_;

class CharacterSeeder extends Seeder
{
    protected $class_assignments = [
        'lisa.waylen'        => 'The Warpling',
        'rachael.turner'     => 'The Shadowmancer',
        'nichola.larkins'    => 'The Druid',
        'marianne.johnstone' => 'The Diva'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('username', '<>', 'sean.meakin')->get();

        foreach($users as $user) {
            Character::create([
                'user_id' => $user['id'],
                'class_id' => CharacterClass::whereName($this->class_assignments[$user['username']])->pluck('id')->first(),
                'needs_creation' => true
            ]);
        }
    }
}
