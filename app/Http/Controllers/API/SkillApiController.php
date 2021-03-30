<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Skill;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SkillApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $character = Character::find($id);
            $acquired = [];
            foreach($character->skills as $skill) {
                $acquired[] = $skill->id;
            }
            return response()->json([
                'success' => true,
                'skills'  => Skill::whereNotIn('id', $acquired)->get()->toArray()
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Could not fetch skills', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'reason'  => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
