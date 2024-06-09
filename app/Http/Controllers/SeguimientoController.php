<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{
    public function show()
    {
        // Obtener el ID del usuario logueado
        $userId = Auth::id();

        // variable que obtendrá los datos de la consulta de la Tabla Ticket
        $datos_ticket = DB::select(' 
        SELECT tickets.*, users.first_name, users.last_name, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
        FROM tickets
        INNER JOIN users ON tickets.user_id = users.id
        INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
        INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
        WHERE tickets.user_id = ?
        ',[$userId]);

        return view('track.track-view')->with('datos_ticket', $datos_ticket);
    }
}
