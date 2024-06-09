<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    public function show()
    {
        // variable que obtendrá los datos de la consulta
        $datos_ticket = DB::select('select * from tickets');
        return view('seguimiento.seguimiento')->with('datos_ticket', $datos_ticket);
    }
}
