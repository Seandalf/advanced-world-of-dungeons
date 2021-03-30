<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\API\SkillApiController;
use App\Http\Controllers\API\SpellApiController;
use App\Http\Controllers\API\ArmourApiController;
use App\Http\Controllers\API\WeaponApiController;
use App\Http\Controllers\API\AbilityApiController;
use App\Http\Controllers\API\SpecialApiController;
use App\Http\Controllers\API\CharacterApiController;
use App\Http\Controllers\API\EquipmentApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/characters/show/{id}', [CharacterApiController::class, 'show']);
Route::patch('/characters/update', [CharacterApiController::class, 'update']);

Route::get('/skills/index/{id}', [SkillApiController::class, 'index']);
Route::get('/abilities/index/{id}', [AbilityApiController::class, 'index']);
Route::get('/armours/index', [ArmourApiController::class, 'index']);
Route::get('/items/index', [EquipmentApiController::class, 'index']);
Route::get('/weapons/index', [WeaponApiController::class, 'index']);
Route::get('/spells/index/{id}', [SpellApiController::class, 'index']);
Route::get('/specials/index/{id}', [SpecialApiController::class, 'index']);

Route::post('/character/level', [CharacterApiController::class, 'levelUp']);
Route::post('/character/shop', [CharacterApiController::class, 'goShopping']);

Route::get('/tools/generator/{generate}/{amount}', [ToolsController::class, 'randomGenerator']);
Route::get('/tools/generator/types', [ToolsController::class, 'randomGeneratorTypes']);
