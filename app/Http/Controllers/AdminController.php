<?php

namespace App\Http\Controllers;

use App\Models\TicketModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function show()
    {
        // variable que obtendrá los datos de la consulta
        $datos_ticket = DB::select(' 
        SELECT tickets.*, users.first_name, users.last_name, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
        FROM tickets
        INNER JOIN users ON tickets.user_id = users.id
        INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
        INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
        ');

        $datos_users = DB::select('
        SELECT users.*, user_department.department, user_status.status_name
        FROM users
        INNER JOIN user_department ON users.user_department_id = user_department.id
        INNER JOIN user_status ON users.user_status_id = user_status.id
        ');

        $datos_ticket_estado = DB::table('ticket_status')->select('id', 'ticket_status_name')->get();

        return view('admin.admin-view', ['datos_ticket' => $datos_ticket, 'datos_ticket_estado' => $datos_ticket_estado, 'datos_users' => $datos_users,]);
    }
}
