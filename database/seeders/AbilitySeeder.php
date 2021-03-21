<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\CharacterClass;
use Illuminate\Database\Seeder;

class AbilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ability::insert([
            [
                'name'     => 'Sorcery of the Earth',
                'effect'   => 'You begin with three nature-based spells',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Wild Tongue',
                'effect'   => 'You can converse with an attempt to command plants and animals',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Crimson Rite',
                'effect'   => 'You can imbue any weapon with a portion of your own life force. Reduce your maximum HP (restored when rite fades) by your character level to allow your weapon to deal an extra 1d4 madical damage, or you can apply one of the following forms of magical damage: fire, cold, lightning, acid, thunder, psychic, or necrotic.',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Haemomancy',
                'effect'   => 'You can create magical effects drawn from the Chaos contained within your blood. You start with a Power score equal to your base Hit Dice + CON. Draw magical runes using your blood to give yourself the following effects. Roll a CON save when opening yourself to the effects of the Warp.<br><span style="font-semibold">Bloodbending:</span> Inflict 2d6 blood damage on skin contact with target<br><span class="font-semibold">Bloodbending:</span> Inflict 2d6 blood damage on skin contact with target<br><span class="font-semibold">Supernatural Ability:</span> Eg. Invisibility, Strength<br><span class="font-semibold">Heightened Skills:</span> +1 to action or +2 to attribute<br><span class="font-semibold">Rapid Healing:</span> Roll your hit die and gain that health instantly<br><span class="font-semibold">Mark of the Hunter:</span> Use your blood to mark an object or living creature and you will always be able to track their location<br>',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Shadow Walking',
                'effect'   => 'You can use any darkness as a portal to step in and out of the shadow realm. While in this realm your speed is doubled, and you are fully aware of the goings on around you, but are undetectable to anyone in the material realm. You cannot interact with any being or object in the material realm while in the shadow realm. You have perfect darkvision.',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Backstab',
                'effect'   => 'Add +3 to melee damage attacks when the target is unaware of your presence.',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Sorcery of the Voice',
                'effect'   => 'You begin with three sound-based spells.',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ]
        ]);
        Ability::insert([
            [
                'name'     => 'Slay',
                'effect'   => 'Inflict +2 damage when delivering attacks teamed with your vicious personal takedowns. Activate this ability by snapping the fingers in an ancient, arcane motion.',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ]
        ]);
    }
}
