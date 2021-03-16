<?php

namespace App\Http\Controllers;

use App\Models\Background;
use App\Models\Character;
use App\Models\Skill;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CharacterController extends Controller
{
    public function index()
    {
        if (Auth::user()->username === 'sean.meakin') {
            $characters = Character::select('id')->pluck('id')->toArray();
            $needs_creation = false;
        } else {
            $characters = Character::whereUserId(Auth::id())->first();
            $needs_creation = $characters->needs_creation;
            $characters = [$characters['id']];
        }

        $skills = [];
        $backgrounds = [];
        if ($needs_creation) {
            $skills = Skill::all()->toArray();
            $backgrounds = Background::all()->toArray();
        }

        return view('character-sheet')->with(compact('characters', 'needs_creation', 'skills', 'backgrounds'));
    }

    public function create(Request $request)
    {
        try {
            $character = Character::whereUserId(Auth::id())->first();

            $character->fill($request->except('_token', 'skill'));
            $character->coin = 100;
            $character->current_hp = $request->max_hp;
            $character->hit_dice = 1 + $request->con;
            $character->needs_creation = false;
            $character->save();

            if ($character->startsWithSpells()) {
                $character->attachStartingSpells();
            }

            $character->skills()->attach($request->skill);
        } catch (Exception $e) {
            Log::error('Could not create character', ['error' => $e->getMessage()]);
        }

        return redirect('/character-sheet');
    }
}
