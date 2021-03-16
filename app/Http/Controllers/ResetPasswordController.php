<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('auth.reset');
    }

    public function resetPassword(Request $request)
    {
        $user = User::find(Auth::id());

        $user->password = Hash::make($request->password);
        $user->reset_password = 0;
        $user->save();

        return redirect('/character-sheet');
    }
}
