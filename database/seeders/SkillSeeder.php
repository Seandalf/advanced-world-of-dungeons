<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::insert([
            [
                'name'         => 'Athletics',
                'flavour_text' => 'Determines how well you can walk the walk, climb the climb, and swim the swim'
            ],
            [
                'name'         => 'Awareness',
                'flavour_text' => 'How well you can see, hear, or otherwise sense things in your immediate presence'
            ],
            [
                'name'         => 'Culture',
                'flavour_text' => 'Your familiarity with the customs, etiquette, art, etc. of a society'
            ],
            [
                'name'         => 'Deception',
                'flavour_text' => 'Determines how well you can lie or trick others and convince them of something that isn\'t true'
            ],
            [
                'name'         => 'Decipher',
                'flavour_text' => 'Your ability to read secret or hidden messages, find hidden meanings, or crack codes'
            ],
            [
                'name'         => 'Arcana',
                'flavour_text' => 'You have an in depth knowledge of magic, how it works for some, and how it differs for us all'
            ],
            [
                'name'         => 'Leadership',
                'flavour_text' => 'Your ability to take control of a situation or group of people and direct them'
            ],
            [
                'name'         => 'Lore',
                'flavour_text' => 'You have knowledge of the history and impact of events or regions'
            ],
            [
                'name'         => 'Survival',
                'flavour_text' => 'Your ability to survive using only your wits and the limited tools around you'
            ],
            [
                'name'         => 'Crafting',
                'flavour_text' => 'Your ability to create something from nothing, turn the mundane into the useful'
            ],
            [
                'name'         => 'Languages',
                'flavour_text' => 'You understand many languages and can hold at least a basic conversation in them'
            ],
            [
                'name'         => 'Mediation',
                'flavour_text' => 'You\'re good at resolving disputes and conversing with people to reach a desired outcome'
            ],
            [
                'name'         => 'Intimidation',
                'flavour_text' => 'You scare people and use that to get what you want from them'
            ],
        ]);
    }
}
