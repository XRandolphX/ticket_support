<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    public function index()
    {
        $datos_prioridad = DB::table('ticket_priority')->select('id', 'ticket_priority_name')->get();
        return view('home.index', ['datos_prioridad' => $datos_prioridad]);
    }
}
