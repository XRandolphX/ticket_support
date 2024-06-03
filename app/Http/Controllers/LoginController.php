<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Verifica si el usuario ya está autenticado.
    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        return view('auth.login');
    }
    // Proceso de Inicio de Sesión.
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (!Auth::validate($credentials)) {
            return redirect()->to('/login')->withErrors('auth.failed');
        }
        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }
    // Si se ha autenticado con éxito se redirecciona a Home.
    public function authenticated(Request $request, $user)
    {
        return redirect('/home');
    }
}

// public function authenticated(Request $request, $user)
// {
//     if ($user->hasRole('admin')) {
//         return redirect('/admin');
//     }

//     return redirect('/home');
// }
