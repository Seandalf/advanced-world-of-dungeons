<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Character;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Equipment;

class CharacterApiController extends Controller
{
    protected $health_levels = [2, 4, 6, 8, 10];
    protected $skill_levels = [3, 6, 9];
    protected $attr_levels = [4, 7, 10];
    protected $ability_levels = [3, 6, 9];
    protected $special_levels = [2, 4, 6, 8, 10];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
            $character = Character::whereId($id)->with(
                'background',
                'class',
                'skills',
                'abilities',
                'equipment',
                'weapons',
                'armours',
                'spells',
                'specials'
            )->first();

            return response()->json([
                'success'   => true,
                'character' => $character
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Problem getting character', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'reason'  => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $req = $request->character;
            $equipment = $req['equipment'];
            $weapons   = $req['weapons'];
            $armours   = $req['armours'];

            $character = Character::find($req['id']);

            $weapons_update = [];
            foreach ($weapons as $weapon) {
                $weapons_update[$weapon['id']] = [
                    'carried' => $weapon['pivot']['carried']
                ];
            }

            $equipment_update = [];
            foreach ($equipment as $equip) {
                $equipment_update[$equip['id']] = [
                    'carried'  => $equip['pivot']['carried'],
                    'uses'     => $equip['pivot']['uses']
                ];
            }

            $armour_update = [];
            foreach ($armours as $armour) {
                $armour_update[$armour['id']] = [
                    'carried'  => $armour['pivot']['carried'],
                    'equipped' => !$armour['pivot']['carried'] ? false : $armour['pivot']['equipped'],
                ];
            }

            $character->weapons()->sync($weapons_update);
            $character->equipment()->sync($equipment_update);
            $character->armours()->sync($armour_update);

            //unset all the relationships
            unset($req['background']);
            unset($req['class']);
            unset($req['skills']);
            unset($req['abilities']);
            unset($req['equipment']);
            unset($req['weapons']);
            unset($req['armours']);
            unset($req['has_spells']);
            unset($req['has_power']);
            unset($req['spells']);
            unset($req['specials']);

            $id = $req['id'];
            unset($req['id']);
            $character->fill($req);
            $character->save();
            $character = Character::whereId($id)->with(
                'background',
                'class',
                'skills',
                'abilities',
                'equipment',
                'weapons',
                'armours',
                'spells',
                'specials'
            )->first();

            return response()->json([
                'success'   => true,
                'character' => $character
            ]);
        } catch (Exception $e) {
            Log::error('Problem updating character', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'reason'  => $e->getMessage()
            ])->setStatusCode(500);
        }
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

    public function levelUp(Request $request)
    {
        try {
            $req = $request->all();

            $character = Character::find($req['character']);
            $character->level = $req['new_level'];
            $character->xp = $character->xp - (($req['new_level'] - 1) * 1000);

            if (in_array($req['new_level'], $this->attr_levels)) {
                switch ($req['stat']) {
                    case 'str':
                        $character->str = $character->str + 1;
                        break;
                    case 'dex':
                        $character->dex = $character->dex + 1;
                        break;
                    case 'con':
                        $character->con = $character->con + 1;
                        break;
                    case 'int':
                        $character->int = $character->int + 1;
                        break;
                    case 'wis':
                        $character->wis = $character->wis + 1;
                        break;
                    case 'cha':
                        $character->cha = $character->cha + 1;
                        break;
                }
            }

            if (in_array($req['new_level'], $this->health_levels)) {
                $character->max_hp = $character->max_hp + (int) $req['hp'];
            }

            $character->save();

            if (in_array($req['new_level'], $this->skill_levels)) {
                $character->skills()->attach($req['skill']);
            }

            if (in_array($req['new_level'], $this->ability_levels)) {
                $character->abilities()->attach($req['ability']);
            }

            if (in_array($req['new_level'], $this->special_levels)) {
                if ($character->has_spells) {
                    $character->spells()->attach($req['special']);
                } else {
                    $character->specials()->attach($req['special']);
                }
            }

            return response()->json([
                'success'   => true
            ]);
        } catch (Exception $e) {
            Log::error('Could not level up character', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'reason'  => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function goShopping(Request $request)
    {
        try {
            $armour = $request->armour;
            $items = $request->items;
            $weapons = $request->weapons;
            $character = Character::find($request->character);

            foreach ($armour as $a) {
                if($character->armours->contains($a)) {
                    foreach($character->armours as $char_armour) {
                        if ($char_armour['id'] === $a) {
                            $armour_quantity = $char_armour['pivot']['quantity'];
                        }
                    }
                    $character->armours()->updateExistingPivot($a, [
                        'quantity' => $armour_quantity + 1
                    ]);
                } else {
                    $character->armours()->attach($a, ['quantity' => 1, 'carried' => 1, 'equipped' => 0]);
                }
            }

            foreach ($items as $item) {
                $item_record = Equipment::find($item);
                if($character->equipment->contains($item)) {
                    foreach($character->equipment as $i) {
                        if ($i['id'] === $item) {
                            $item_quantity = $i['pivot']['quantity'];
                            if ($item_record['uses'] !== null) {
                                $item_uses = $i['pivot']['uses'];
                            } else {
                                $item_uses = null;
                            }
                        }
                    }
                    $arr['quantity'] = $item_quantity + 1;
                    if ($item_record['uses'] !== null && $item_record['uses'] > 0) {
                        $arr['uses'] = $item_uses + $item_record['uses'];
                    } else {
                        $arr['uses'] = null;
                    }
                    $character->equipment()->updateExistingPivot($item, $arr);
                } else {
                    $arr = ['quantity' => 1, 'carried' => 1, 'equipped' => 0];
                    if ($item_record['uses'] !== null) {
                        $arr['uses'] = $item_record['uses'];
                    } else {
                        $arr['uses'] = null;
                    }
                    $character->equipment()->attach($item, $arr);
                }
            }

            foreach ($weapons as $weapon) {
                if($character->weapons->contains($weapon)) {
                    foreach($character->weapons as $char_weapon) {
                        if ($char_weapon['id'] === $a) {
                            $weapon_quantity = $char_weapon['pivot']['quantity'];
                        }
                    }
                    $character->weapons()->updateExistingPivot($a, [
                        'quantity' => $weapon_quantity + 1
                    ]);
                } else {
                    $character->weapons()->attach($a, ['quantity' => 1, 'carried' => 1, 'equipped' => 0]);
                }
            }

            $character->coin = $character->coin - $request->total;
            $character->save();

            return response()->json([
                'success' => true
            ])->setStatusCode(200);
        } catch (Exception $e) {
            Log::error('Could not go shopping', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'reason'  => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
