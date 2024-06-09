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
// Librería para exportar a word
use PhpOffice\PhpWord\PhpWord;

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
    public function store(TicketRegisterRequest $request)
    {

        // Primero, validamos los datos del formulario
        $validated = $request->validated();

        // Luego, creamos una nueva instancia de TicketModel
        $ticket = new TicketModel($validated);
        // dd($ticket);

        // Asignamos el user_id al usuario autenticado y el ticket_status_id a un valor predeterminado
        $ticket->user_id = auth()->id();
        $ticket->ticket_status_id = 1; // id predeterminado 1 ("Abierto")

        // Intentamos guardar el ticket en la base de datos
        if ($ticket->save()) {
            // El ticket se guardó correctamente
            // Redirigir al usuario a una página de éxito
            return redirect('/seguimiento')->with('status', 'Ticket registrado con éxito!');
        } else {
            // Hubo un problema al guardar el ticket
            return back()->with('error', 'Hubo un problema al registrar el ticket.');
        }
    }

    public function wordExport()
    {
        // Se crea un nuevo documento de Word
        $word = new PhpWord();
        // Se agrega una sección en el documento Word
        $section = $word->addSection();

        // Estilo de la tabla
        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize'  => 6,
            'cellMargin'  => 50,
            'layout' => \PhpOffice\PhpWord\Style\Table::LAYOUT_FIXED
        );

        // Estilo de la primera fila
        $firstRowStyle = array(
            'bgColor' => '005599',
        );

        // Estilo del texto de la primera fila
        $firstRowFontStyle = array('bold' => true, 'color' => 'FFFFFF', 'size' => 12);

        // Estilo de las celdas de la primera fila
        $firstRowCellStyle = array('valign' => 'center');

        // Estilo del texto de las celdas
        $cellFontStyle = array('size' => 10);

        // Agregar el estilo de la tabla al documento
        $word->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        //  Agregar la tabla al documento
        $table = $section->addTable('myTable');

        // Agregar la primera fila
        $table->addRow();
        $table->addCell(2000, $firstRowCellStyle)->addText('#Ticket ID', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Asunto', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Descripción', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Nombre de usuario', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Estado', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Prioridad', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Creado', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Actualizado', $firstRowFontStyle);

        // variable que obtendrá los datos de la consulta
        $datos_ticket = DB::select(' 
                SELECT tickets.*, users.username, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
                FROM tickets
                INNER JOIN users ON tickets.user_id = users.id
                INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
                INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
                ');

        // Agregar las filas y celdas
        foreach ($datos_ticket as $item) {
            $table->addRow();
            $table->addCell(2000)->addText($item->id, $cellFontStyle);
            $table->addCell(2000)->addText($item->subject, $cellFontStyle);
            $table->addCell(2000)->addText($item->description, $cellFontStyle);
            $table->addCell(2000)->addText($item->username, $cellFontStyle);
            $table->addCell(2000)->addText($item->ticket_status_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->ticket_priority_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->created_at, $cellFontStyle);
            $table->addCell(2000)->addText($item->updated_at, $cellFontStyle);
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        $objWriter->save('mi_documento.docx');

        // Guardar el documento
        return response()->download('mi_documento.docx');
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

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
