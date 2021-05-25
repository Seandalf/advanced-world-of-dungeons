<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Ability;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbilityApiController extends Controller
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
            foreach($character->abilities as $ability) {
                $acquired[] = $ability->id;
            }
            return response()->json([
                'success' => true,
                'abilities'  => Ability::where(function ($query) use ($character) {
                                            $query->whereClassId($character->class_id)
                                                  ->orWhereNull('class_id');
                                        })
                                        ->whereNotIn('id', $acquired)
                                        ->get()
                                        ->toArray()
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Could not fetch abiities', ['error' => $e->getMessage()]);
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
