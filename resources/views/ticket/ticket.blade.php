{{-- En esta vista estoy heredando la plantilla de diseño ticket-master --}}
@extends('layouts.ticket-master')

@section('content')
    <h1 class="text-center p-3">Generar ticket</h1>

    <!-- Modal Registrar Datos-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-ticket') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtasunto">
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Prioridad
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" data-value="Emergencia" href="#">Emergencia</a></li>
                                <li><a class="dropdown-item" data-value="Alta" href="#">Alta</a></li>
                                <li><a class="dropdown-item" data-value="Normal" href="#">Normal</a></li>
                                <li><a class="dropdown-item" data-value="Baja" href="#">Baja</a></li>
                            </ul>
                            <input type="hidden" name="prioridad" id="prioridad-input">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="txtdescripcion">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 table-responsive">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar
            Ticket</button>
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
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->user_id }}</td>
                        <td>{{ $item->ticket_status_id }}</td>
                        <td>{{ $item->ticket_priority_id }}</td>
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
        </table>
    </div>
@endsection
