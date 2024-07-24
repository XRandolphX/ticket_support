<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRegisterRequest;
use App\Mail\MailSend;
use App\Mail\MailUpdate;
use Illuminate\Http\Request;
// Se Cargan los modelos de las tablas que estamos uniendo
use App\Models\TicketModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
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
        $ticket->save();

        // Enviar correo de notificación
        Mail::to('informatica@ugelsullana.com')->send(new MailSend($ticket));

        // Redirige con un mensaje de éxito
        return redirect()->back()->with('success', 'Ticket registrado con éxito.');

        // if ($ticket->save()) {
        //     return redirect('/seguimiento')->with('status', 'Ticket registrado con éxito!');
        // } else {
        //     return back()->with('error', 'Hubo un problema al registrar el ticket.');
        // }
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
            // Enviar correo de notificación
            Mail::to('informatica@ugelsullana.com')->send(new MailUpdate());
            return response()->json(['status' => 'correcto', 'message' => 'Ticket actualizado correctamente']);
        } else {
            return response()->json(['status' => 'incorrecto', 'message' => 'Error al actualizar'], 500);
        }
    }
    //Eliminar
    public function destroy($id)
    {
        try {
            $ticket = TicketModel::findOrFail($id);
            $ticket->delete();
            return response()->json(['status' => 'correcto', 'message' => 'Ticket eliminado correctamente']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'incorrecto', 'message' => 'Error al eliminar el ticket'], 500);
        }
    }

    //Método de buscar en tu Controlador
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Obtener el ID del usuario logueado
        $userId = Auth::id();

        $datos_ticket = TicketModel::with(['ticket_user', 'ticket_status', 'ticket_priority'])
            ->where('user_id', $userId) // Filtrar por usuario autenticado
            ->where(function ($q) use ($query) {
                $q->where('subject', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->orWhereHas('ticket_user', function ($q) use ($query) {
                        $q->where('first_name', 'like', "%$query%")
                            ->orWhere('last_name', 'like', "%$query%");
                    })
                    ->orWhereHas('ticket_status', function ($q) use ($query) {
                        $q->where('ticket_status_name', 'like', "%$query%");
                    })
                    ->orWhereHas('ticket_priority', function ($q) use ($query) {
                        $q->where('ticket_priority_name', 'like', "%$query%");
                    });
            })
            ->get();

        return view('track/track-view', compact('datos_ticket'));
    }


    // Exportar el reporte en formato Word
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



    //Exportar en PDF
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

    // Tabla QR
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

    //Generar el código QR
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
}
