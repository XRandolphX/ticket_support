<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vista Admin</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
</head>

<body>
    <h1>Vista Administrador</h1>
    <div><a href="/word-export" class="btn btn-primary">Exportar a Word</a></div>
    {{-- Tabla donde se mostrarán los datos de los Tickets y Usuarios --}}
    <div class="p-4 table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">#Ticket ID</th>
                    <th scope="col">Asunto</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Prioridad</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Fecha de actualización</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos_ticket as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->ticket_status_name }}</td>
                        <td>{{ $item->ticket_priority_name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar"
                                class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                        <!-- Modal Modificar Datos-->
                        <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Ticket</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Asunto</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Descripción</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Estado</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Prioridad</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" name="txtcodigo">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </div>
        </table>
</body>

</html>
