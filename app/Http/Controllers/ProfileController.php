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
        $user->update($request->all());
        return redirect()->to('profile')->with('success', 'Datos actualizados correctamente!');
    }
}
