<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Tickets</title>
</head>
<body>
    <table border="1">
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
        <tbody>
            @foreach($datos_ticket as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->subject }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->ticket_priority_name }}</td>
                    <td>{{ $item->ticket_status_name }}</td>
                    <td>{{ $item->first_name }}</td>
                    <td>{{ $item->last_name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div><a href="/pdf-export" class="btn btn-primary">Exportar a PDF</a></div>
</body>
</html>
