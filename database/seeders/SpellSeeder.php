<?php

namespace Database\Seeders;

use App\Models\Spell;
use App\Models\CharacterClass;
use Illuminate\Database\Seeder;

class SpellSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Spell::insert([
            [
                'name'     => 'Armour of Agony',
                'effect'   => 'Surround yourself with a shield of Warp magic to inflict agony on enemies which damage you',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'Blight',
                'effect'   => 'Putrefy crops and foodstuffs with rot or sicken another creature and give them disadvantage to rolls of a random attribute',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'Say Hello to My Little Friend',
                'effect'   => 'Use your blood to raise a corpse or pile of bones which acts under your command until killed for 1 HP',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'Use the Force',
                'effect'   => 'You can telekinetically summon any item within range marked with your blood into your hand',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'Vampiric Touch',
                'effect'   => 'Siphon 1d6 damage from an enemy and restore your health',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'You\'ve Got Red on You',
                'effect'   => 'When wearing the blood of another creature, you have advantage to attacks against them',
                'class_id' => CharacterClass::whereName('The Warpling')->pluck('id')->first()
            ],
            [
                'name'     => 'Florals, for Spring?',
                'effect'   => 'Channel your energies into growing the plants you attune with instantly to their full potential',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Nature\'s Fury',
                'effect'   => 'All targets within range are dealt 1d6 damage from a nature element of your choosing eg. thorny vines, freezing hail',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Ain\'t Nobody Got Time for That',
                'effect'   => 'Magically perform a simple, mundane task in an instant',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Not the Beeeeeees!',
                'effect'   => 'Summon a swarm of small animals from nearby to surround a target, they will only attack if provoked',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'The Element of Surprise',
                'effect'   => 'Generate a new weather effect in range by shouting "Surprise"',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'I Am Groot',
                'effect'   => 'When surrounded by nature, you can melt into the background and become invisible',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'How Do You Ward To Do This',
                'effect'   => 'Surround yourself with an element of your choosing, and gain immunity to it\'s harm',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Polymorph',
                'effect'   => 'Transform a creature into a new form, an unwilling creature must pass a WIS save',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Like a Leaf on the Wind',
                'effect'   => 'Reduce your weight to that of a leaf and use the wind to soar',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'I Have a Lotion For That',
                'effect'   => 'You have a herbal remedy for any natural ailment you encounter, more severe ailments will require longer term treatment',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Moisturise Me!',
                'effect'   => 'Apply a soothing balm to heal the target by the value of your character level + 1d6',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Difficult, Difficult, Lemon Difficult',
                'effect'   => 'Once a day you can convert any failed roll into a full success (you do not have to roll to cast this spell)',
                'class_id' => CharacterClass::whereName('The Druid')->pluck('id')->first()
            ],
            [
                'name'     => 'Tinkering',
                'effect'   => 'Pick locks, repair small objects, invent small machines, spend time studying an object to understand how it\'s made and can be unmade',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Who Turned Out The Lights',
                'effect'   => 'You can draw all light from a defined area',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Strategic Withdrawal',
                'effect'   => 'ou can escape any non-magical restraints, and are always able to find an exit',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Spider Climb',
                'effect'   => 'One willing creature you touch gains the ability to move up, down, and across vertical surfaces and upside down along ceilings, while leaving its hands free',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Glyphs',
                'effect'   => 'Create glyphs triggered by an action of your choosing to create one of the following effects:<br><ul><li>A smoke screen</li><li>An audible or mental alarm</li><li>A blast of light</li></ul>',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Are You Watching Closely',
                'effect'   => 'You create an image of an object or creature within range, or create any similar effect with light',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Now You See Me',
                'effect'   => 'Create three mirror images of yourself',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Where\'s My Super Suit?',
                'effect'   => 'You can change your own appearance including your clothing, armor, weapons.',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'The Light Fantastic',
                'effect'   => 'Do you know what happens to a toad when it\'s struck by lightning? The same thing as everything else',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Shadow Blade',
                'effect'   => 'Concentrate the darkness around you into a magical blade',
                'class_id' => CharacterClass::whereName('The Shadowmancer')->pluck('id')->first()
            ],
            [
                'name'     => 'Siren Song',
                'effect'   => 'Targets must roll to resist your alluring call, if they fail they fall under your spell and are receptive to suggestion',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Wall of Sound',
                'effect'   => 'Manipulate sound waves to form a physical barrier to act as a shield, or cast as 1d6 bludgeoning damage against nearby targets',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Noise Pollution',
                'effect'   => 'Overwhelm a target with directed sonic blasts, they must roll to resist or be incapacitated',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Phantom of the Opera',
                'effect'   => 'Targeted soundwaves to perform telekinesis/shattering',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Walking in the Air',
                'effect'   => 'Harness soundwaves to allow yourself or others to levitate, or soften hard landings',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Clever Girl',
                'effect'   => 'When you draw a target\'s attention to you, your allies take advantage in attacks against them',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Are You Not Entertained?',
                'effect'   => 'Instill powerful feelings in large groups of people, eg. transform a peaceful audience into a baying mob or vice-versa',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'The Show Must Go On',
                'effect'   => 'Bring a fallen comrade back to 1HP',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Spirit Fingers',
                'effect'   => 'Shoot three darts of concentrated fabulosity for 1d4 damage each',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Jazz Hands',
                'effect'   => 'Put one target (or 1d6 group targets) to sleep by mesmerising them with your hands',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Cone of Silence',
                'effect'   => 'Suppress all sound in area until you choose to end this spell or lose sight of the area',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Once Upon a Time',
                'effect'   => 'You remember every story and folk legend you ever heard, and have knowledge of many places',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'All About That Bass',
                'effect'   => 'Use low frequency harmonies to start liquifying a target\'s internal organs, dealing 1d8 internal damage',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Living on a Prayer',
                'effect'   => 'Serenade a comrade with a song so beautiful that they regain 1 hit die of health',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ],
            [
                'name'     => 'Eye Of The Tiger',
                'effect'   => 'You can use echolocation to determine the approximate layout of an area, and living beings located within',
                'class_id' => CharacterClass::whereName('The Diva')->pluck('id')->first()
            ]
        ]);
    }
}
