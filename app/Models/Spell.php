<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spell extends Model
{
    use HasFactory;

    public function characters()
    {
        return $this->belongsToMany(Character::class);
    }

    public function class()
    {
        return $this->belongsTo(CharacterClass::class, 'id', 'class_id');
    }
}
