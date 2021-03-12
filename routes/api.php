<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SkillApiController;
use App\Http\Controllers\API\ArmourApiController;
use App\Http\Controllers\API\AbilityApiController;
use App\Http\Controllers\API\CharacterApiController;

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

Route::get('/skills/index', [SkillApiController::class, 'index']);
Route::get('/abilities/index', [AbilityApiController::class, 'index']);
Route::get('/armours/index', [ArmourApiController::class, 'index']);

Route::post('/character/level', [CharacterApiController::class, 'levelUp']);
