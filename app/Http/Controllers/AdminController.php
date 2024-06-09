<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // variable que obtendrá los datos de la consulta
        $datos_ticket = DB::select(' 
        SELECT tickets.*, users.username, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
        FROM tickets
        INNER JOIN users ON tickets.user_id = users.id
        INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
        INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
        ');

        return view('admin.admin-view')->with('datos_ticket', $datos_ticket);

        // $datos_ticket = DB::select(' select * from tickets.*, ');
    }
}
