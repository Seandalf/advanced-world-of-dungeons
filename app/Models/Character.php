<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['has_spells', 'has_power'];

    public function background()
    {
        return $this->belongsTo(Background::class);
    }

    public function class()
    {
        return $this->belongsTo(CharacterClass::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function specials()
    {
        return $this->belongsToMany(Special::class);
    }

    public function spells()
    {
        return $this->belongsToMany(Spell::class);
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }

    public function equipment()
    {
        return $this->belongsToMany(Equipment::class)->withPivot('equipped', 'carried', 'quantity', 'uses');
    }

    public function armours()
    {
        return $this->belongsToMany(Armour::class)->withPivot('equipped', 'carried', 'quantity');
    }

    public function weapons()
    {
        return $this->belongsToMany(Weapon::class)->withPivot('carried', 'quantity');
    }

    public function getHasSpellsAttribute()
    {
        return $this->class->has_spells ? true : false;
    }

    public function getHasPowerAttribute()
    {
        return $this->class->has_power ? true : false;
    }

    public function startsWithSpells()
    {
        return in_array($this->class->name, ['The Druid', 'The Diva']);
    }

    public function attachStartingSpells()
    {
        switch ($this->class->name) {
            case 'The Druid':
                $this->spells()->attach(Spell::whereIn('name', [
                    'Florals, for Spring?',
                    'Nature\'s Fury',
                    'Ain\'t Nobody Got Time for That'
                ])->pluck('id')->toArray());
                break;
            case 'The Diva':
                $this->spells()->attach(Spell::whereIn('name', [
                    'Siren Song',
                    'Wall of Sound',
                    'Noise Pollution'
                ])->pluck('id')->toArray());
                break;
        }
        return true;
    }
}
