<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth()->user();
        return view('auth.profile', ['user' => $user]);
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth()->user();
        if (!$user->update($request->all())) {
            return redirect()->route('profile')->with('error', 'Ha ocurrido un error');
        }

        return redirect()->route('profile')->with('success', 'Datos actualizados correctamente!');
    }
}
