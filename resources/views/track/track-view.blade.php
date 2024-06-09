<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Ticket</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.partials.navbar')
    <h1>Seguimiento del ticket</h1>
    {{-- Tabla donde se mostrarán los datos de los Tickets y Usuarios --}}
    <div class="p-4 table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#Ticket ID</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Fecha de actualización</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos_ticket as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
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
        <div><a href="/word-export" class="btn btn-primary">Exportar a Word</a></div>
    </div>
</body>

</html>
