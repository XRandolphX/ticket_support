<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    //
    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        // $datos_area = DB::table('user_department')->pluck('department');
        $datos_area = DB::table('user_department')->select('id', 'department')->get();
        return view('auth.register')->with('datos_area', $datos_area,);
    }
    //Crea el usuario y no permite que se repita el nombre de usuario y correo.
    public function register(RegisterRequest $request)
    {
        // dd($request->all()); // Imprime todos los datos del formulario
        $user = UserModel::create($request->validated());
        auth()->login($user);
        return redirect('/login')->with('success', 'Cuenta creada satisfactoriamente');
    }
}
