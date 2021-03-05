<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

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
}
