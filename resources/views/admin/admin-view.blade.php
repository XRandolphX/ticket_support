{{-- Acá estoy heredando del app-master Principal --}}
@extends('layouts.app-master')

@section('content')
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
                    <th scope="col">Prioridad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Fecha de creación</th>
                    <th scope="col">Fecha de actualización</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($datos_ticket as $ticket)
                    <tr>
                        <th>{{ $ticket->id }}</th>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->ticket_priority_name }}</td>
                        <td>{{ $ticket->ticket_status_name }}</td>
                        <td>{{ $ticket->first_name }}</td>
                        <td>{{ $ticket->last_name }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>
                            <a href="#" data-id="{{ $ticket->id }}"
                                data-status-id="{{ $ticket->ticket_status_id }}" class="btn btn-warning btn-sm btn-edit"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a href="#" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Modificar Datos-->
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Ticket</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- FORM PARA ENVIAR LOS DATOS A ACTUALIZAR --}}
                    <form id="formEditar" action="{{ route('actualizar-tickets') }}" method="POST">
                        @csrf
                        <input type="text" name="id" id="ticketId">
                        {{-- Dropdown Estado --}}
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="prioridad" class="form-label">Estado</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{-- Primer componente --}}
                                    <div class="mb-3">
                                        <select class="selectpicker" data-live-search="true" name="txt_ticket_status_id"
                                            id="txt_ticket_status_id">
                                            <option selected disabled data-tokens="Action" value="">Seleccionar Estado
                                            </option>
                                            @if (isset($datos_ticket_estado))
                                                @foreach ($datos_ticket_estado as $item)
                                                    <option value="{{ $item->id }}">{{ $item->ticket_status_name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
