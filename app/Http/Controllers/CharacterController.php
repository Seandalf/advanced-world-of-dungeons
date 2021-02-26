<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CharacterController extends Controller
{
    public function index()
    {
        if (Auth::user()->username === 'sean.meakin') {
            $characters = Character::select('id')->pluck('id')->toArray();
        } else {
            $characters = Character::whereUserId(Auth::id())->pluck('id')->toArray();
        }

        return view('character-sheet')->with(compact('characters'));
    }
}
