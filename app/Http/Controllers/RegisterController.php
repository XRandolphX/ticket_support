<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    //
    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.register');
    }
    //Crea el usuario y no permite que se repita el nombre de usuario y correo.
    public function register(RegisterRequest $request)
    {
        $user = UserModel::create($request->validated());
        return redirect('/login')->with('success', 'Cuenta creada satisfactoriamente');
    }
}
