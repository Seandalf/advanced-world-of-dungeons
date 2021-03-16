<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterClass extends Model
{
    use HasFactory;

    public function characters()
    {
        return $this->hasMany(Character::class);
    }

    public function spells()
    {
        return $this->hasMany(Spell::class, 'class_id');
    }

    public function specials()
    {
        return $this->hasMany(Special::class, 'class_id');
    }

    public function hasSpells()
    {
        return $this->has_spells;
    }
}
