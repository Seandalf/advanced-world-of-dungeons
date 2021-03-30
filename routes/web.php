<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/character-sheet', 301);

Route::get('/character-sheet', [CharacterController::class, 'index'])->middleware(['auth'])->name('character');
Route::post('/character/create', [CharacterController::class, 'create'])->middleware(['auth'])->name('character.create');

Route::get('/reset', [ResetPasswordController::class, 'index'])->middleware(['auth'])->name('pass.reset');
Route::post('/reset', [ResetPasswordController::class, 'resetPassword'])->middleware(['auth'])->name('pass.reset');

Route::get('/cowboy', function() {
    return Hash::make('Kappa9gamma0');
});

require __DIR__ . '/auth.php';
