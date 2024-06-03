<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //Mostrar vista y pasar los datos del departamento para el dropdown.
    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        $datos_area = DB::table('user_department')->select('id', 'department')->get();
        return view('auth.register')->with('datos_area', $datos_area,);
    }
    //Crea el usuario y no permite que se repita el nombre de usuario y correo.
    public function register(RegisterRequest $request)
    {
        $user = UserModel::create($request->validated());
        auth()->login($user);
        return redirect('/login')->with('success', 'Cuenta creada satisfactoriamente');
    }
}
