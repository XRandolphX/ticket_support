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
use Illuminate\Support\Facades\Log;
// Librería para exportar a word
use PhpOffice\PhpWord\PhpWord;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TCPDF;

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

    //  Registrar
    public function store(TicketRegisterRequest $request)
    {
        // Primero, validamos los datos del formulario
        $validated = $request->validated();

        // Luego, creamos una nueva instancia de TicketModel
        $ticket = new TicketModel($validated);

        // Asignamos el user_id al usuario autenticado y el ticket_status_id a un valor predeterminado
        $ticket->user_id = auth()->id();
        $ticket->ticket_status_id = 1; // id predeterminado 1 ("Abierto")

        // Guardar el ticket en la base de datos
        if ($ticket->save()) {
            return redirect('/seguimiento')->with('status', 'Ticket registrado con éxito!');
        } else {
            return back()->with('error', 'Hubo un problema al registrar el ticket.');
        }
    }

    // Actualizar 
    public function update(Request $request)
    {
        try {
            $sql = DB::update('update tickets set ticket_status_id=?, updated_at=? where id=?', [$request->txt_ticket_status_id, now(), $request->id]);
        } catch (\Throwable $th) {
            $sql = 0;
        }
        if ($sql == true) {
            return response()->json(['status' => 'correcto', 'message' => 'Ticket actualizado correctamente']);
        } else {
            return response()->json(['status' => 'incorrecto', 'message' => 'Error al actualizar'], 500);
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
        $firstRowFontStyle = array('bold' => true, 'color' => 'FFFFFF', 'size' => 10);

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
        $table->addCell(2000, $firstRowCellStyle)->addText('Prioridad', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Estado', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Nombres', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Apellidos', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Creado', $firstRowFontStyle);
        $table->addCell(2000, $firstRowCellStyle)->addText('Actualizado', $firstRowFontStyle);

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
        ', [$userId]);

        // Agregar las filas y celdas
        foreach ($datos_ticket as $item) {
            $table->addRow();
            $table->addCell(2000)->addText($item->id, $cellFontStyle);
            $table->addCell(2000)->addText($item->subject, $cellFontStyle);
            $table->addCell(2000)->addText($item->description, $cellFontStyle);
            $table->addCell(2000)->addText($item->ticket_priority_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->ticket_status_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->first_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->last_name, $cellFontStyle);
            $table->addCell(2000)->addText($item->created_at, $cellFontStyle);
            $table->addCell(2000)->addText($item->updated_at, $cellFontStyle);
        }

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        $objWriter->save('tickets.docx');

        // Guardar el documento
        return response()->download('tickets.docx');
    }



 
    public function pdfExport()
    {
        // Obtener el ID del usuario logueado
        $userId = Auth::id();
    
        // Variable que obtendrá los datos de la consulta de la Tabla Ticket
        $datos_ticket = DB::select(' 
        SELECT tickets.*, users.first_name, users.last_name, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
        FROM tickets
        INNER JOIN users ON tickets.user_id = users.id
        INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
        INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
        WHERE tickets.user_id = ?
        ', [$userId]);
    
        // Crear una nueva instancia de TCPDF
        $pdf = new TCPDF();
    
        // Configurar el documento PDF
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('TuNombre');
        $pdf->SetTitle('Tickets Report');
        $pdf->SetSubject('Reporte de Tickets');
        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    
        // Agregar una página
        $pdf->AddPage();
    
        // Título
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 15, 'Reporte de Tickets', 0, 1, 'C');
    
        // Tabla
        $pdf->SetFont('helvetica', '', 10);
        $html = '<table border="1" cellpadding="4">
                    <thead>
                        <tr>
                            <th>#Ticket ID</th>
                            <th>Asunto</th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                            <th>Estado</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Creado</th>
                            <th>Actualizado</th>
                        </tr>
                    </thead>
                    <tbody>';
    
        // Agregar las filas y celdas
        foreach ($datos_ticket as $item) {
            $html .= '<tr>
                        <td>' . $item->id . '</td>
                        <td>' . $item->subject . '</td>
                        <td>' . $item->description . '</td>
                        <td>' . $item->ticket_priority_name . '</td>
                        <td>' . $item->ticket_status_name . '</td>
                        <td>' . $item->first_name . '</td>
                        <td>' . $item->last_name . '</td>
                        <td>' . $item->created_at . '</td>
                        <td>' . $item->updated_at . '</td>
                      </tr>';
        }
    
        $html .= '</tbody></table>';
    
        // Output HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
    
        // Cerrar y generar el documento PDF
        $pdf->lastPage();
        $pdf->Output('tickets.pdf', 'D');
    
        // Guardar el documento
        return response()->download('tickets.pdf');
    }
    
    




    public function showTableQr()
    {
        // Obtener el ID del usuario logueado
        $userId = Auth::id();

        // Obtener los datos de la tabla Ticket
        $datos_ticket = DB::select(' 
        SELECT tickets.*, users.first_name, users.last_name, ticket_priority.ticket_priority_name, ticket_status.ticket_status_name
        FROM tickets
        INNER JOIN users ON tickets.user_id = users.id
        INNER JOIN ticket_priority ON tickets.ticket_priority_id = ticket_priority.id
        INNER JOIN ticket_status ON tickets.ticket_status_id = ticket_status.id
        WHERE tickets.user_id = ?
        ', [$userId]);

        return view('tabla_qr_view', compact('datos_ticket'));
    }


    // public function generateQRCode()
    // {
    //     try {
    //         $url = route('export.qr');
    //         $qr = QrCode::format('png')->size(300)->generate($url);

    //         return response()->json(['qr' => base64_encode($qr)]);
    //     } catch (\Exception $e) {
    //         Log::error('Error generating QR code: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
    //         return response()->json(['error' => 'Error generating QR code'], 500);
    //     }
    // }



    public function generateQRCode()
    {
        try {
            $url = route('table.qr');
            $qr = QrCode::size(300)->generate($url);

            return view('qr_view', compact('qr', 'url'));
        } catch (\Exception $e) {
            Log::error('Error generating QR code: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
            return response()->json(['error' => 'Error generating QR code'], 500);
        }
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
