<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRegisterRequest;
use Illuminate\Http\Request;
// Se Cargan los modelos de las tablas que estamos uniendo
use App\Models\State_Ticket;
use App\Models\Ticket;
use App\Models\TicketModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $tickets = Ticket::with('setEstadoTicket')->get();
    //     $state_ticket = State_Ticket::with('setIdTicket')->get();

    //     return view('layouts.tabla', compact('tickets','state_ticket'));
    //     return view('layouts.tabla');
    //     return view ('ticket.ticket'); 
    // }

    public function show()
    {
        if (Auth::check()) {
            return redirect('/home');
        }
        $datos_prioridad = DB::table('ticket_priority')->select('id', 'ticket_priority_name')->get();
        return view('ticket.ticket')->with('datos_prioridad', $datos_prioridad);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TicketRegisterRequest $request)
    {

        // dd($request->all()); // Imprime todos los datos del formulario

        // Primero, validamos los datos del formulario
        $validated = $request->validated();

        // Luego, creamos una nueva instancia de Ticket
        $ticket = new TicketModel;

        // Asignamos los valores a las propiedades del ticket
        $ticket->subject = $validated['subject'];
        $ticket->description = $validated['description'];
        // $ticket->user_id = $validated['user_id'];
        // $ticket->ticket_status_id = $validated['ticket_status_id'];
        $ticket->ticket_priority_id = $validated['ticket_priority_id'];

        $ticket->user_id = auth()->user()->id; // Aquí se asigna el id del usuario autenticado


        // Guardamos el ticket en la base de datos
        $ticket->save();

        // Redirigimos al usuario a la página de agradecimiento o a la lista de tickets
        // return redirect()->route('seguimiento.seguimiento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
