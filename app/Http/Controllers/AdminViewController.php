<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminViewController extends Controller
{
    public function index()
    {
        // return view('admin-view');
        // variable que obtendrá los datos de la consulta
        $datos = DB::select(' select * from tickets ');
        return view('admin-view')->with('datos', $datos,);
    }
}
