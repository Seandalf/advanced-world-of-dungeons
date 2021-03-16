<?php

namespace Database\Seeders;

use App\Models\CharacterClass;
use Illuminate\Database\Seeder;

class CharacterClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CharacterClass::insert([
            [
                'name'       => 'The Warpling',
                'effect'     => 'After exposure to the power of Chaos at a young age, Warplings become tainted and their blood carries dark power, but always used at a cost. Your spellcasting attribute is Constitution.',
                'has_spells' => true,
                'has_power'  => true
            ],
            [
                'name'       => 'The Shadowmancer',
                'effect'     => '"Oh, you think darkness is your ally. But you merely adopted the dark; I was born in it, moulded by it. I didn\'t see the light until I was already a man, by then it was nothing to me but BLINDING!". Your spellcasting attribute is Intelligence.',
                'has_spells' => true,
                'has_power'  => false
            ],
            [
                'name'       => 'The Druid',
                'effect'     => 'Born with an innate connection to the natural world around them, Druids source their magical power from the elements of the earth and sky. Your spellcasting attribute is Wisdom.',
                'has_spells' => true,
                'has_power'  => false
            ],
            [
                'name'       => 'The Diva',
                'effect'     => 'When the theatrical community couldn’t handle the drama, The Diva emerged reborn as a phoenix of pure spectacle. Your spellcasting attribute is Charisma.',
                'has_spells' => true,
                'has_power'  => false
            ],
        ]);
    }
}
