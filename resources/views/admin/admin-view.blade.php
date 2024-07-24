@extends('layouts.app-master')

@section('content')
    @guest
        <div class="main-container">
            <div class="info-box">
                <h2>Bienvenido</h2>
                <p>Para ver el contenido <a href="/login" class="btn-theme">Inicia sesión</a></p>
            </div>
        </div>
    @endguest

    @auth
        <div class="container py-4">
            <div class="mb-5">
                <h1>Vista Administrador</h1>
            </div>
            <!-- Tabla de Tickets -->
            <div class="table-responsive mb-5">
                <h2>Tickets</h2>
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
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos_ticket as $ticket)
                            <tr id="ticket-{{ $ticket->id }}">
                                <td>{{ $ticket->id }}</td>
                                <td>{{ $ticket->subject }}</td>
                                <td>{{ $ticket->description }}</td>
                                <td>{{ $ticket->ticket_priority_name }}</td>
                                <td class="ticket-status">{{ $ticket->ticket_status_name }}</td>
                                <td>{{ $ticket->first_name }}</td>
                                <td>{{ $ticket->last_name }}</td>
                                <td>{{ $ticket->created_at }}</td>
                                <td class="updated-at">{{ $ticket->updated_at }}</td>
                                <td>
                                    <a href="#" data-id="{{ $ticket->id }}"
                                        data-status-id="{{ $ticket->ticket_status_id }}"
                                        class="btn btn-warning btn-sm btn-edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $ticket->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mb-3 d-flex justify-content-end">
                    <a href="/word-export" class="btn btn-primary">Exportar a Word</a>
                </div>
            </div>

            <!-- Modal Modificar Datos -->
            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Ticket</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditar" method="POST">
                                @csrf
                                <input type="hidden" name="id" id="ticketId">
                                <div class="mb-3">
                                    <label for="txt_ticket_status_id" class="form-label">Estado</label>
                                    <select class="form-select" name="txt_ticket_status_id" id="txt_ticket_status_id">
                                        <option selected disabled value="">Seleccionar Estado</option>
                                        @if (isset($datos_ticket_estado))
                                            @foreach ($datos_ticket_estado as $item)
                                                <option value="{{ $item->id }}">{{ $item->ticket_status_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla de Usuarios -->
            <div class="table-responsive">

                <table class="table table-striped table-bordered table-hover">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col">#User ID</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Email</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Creación</th>
                            <th scope="col">Actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datos_users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->department }}</td>
                                <td>{{ $user->status_name }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.btn-delete').forEach(button => {
                    button.addEventListener('click', function() {
                        const ticketId = this.getAttribute('data-id');
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "No podrás revertir esto",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/eliminar-ticket/${ticketId}`, {
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': document.querySelector(
                                                'meta[name="csrf-token"]').getAttribute(
                                                'content')
                                        }
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.status === 'correcto') {
                                            document.getElementById(`ticket-${ticketId}`)
                                                .remove();
                                            Swal.fire(
                                                'Eliminado',
                                                'El ticket ha sido eliminado.',
                                                'success'
                                            );
                                        } else {
                                            Swal.fire(
                                                'Error',
                                                'Hubo un problema al eliminar el ticket.',
                                                'error'
                                            );
                                        }
                                    })
                                    .catch(error => {
                                        Swal.fire(
                                            'Error',
                                            'Hubo un problema al eliminar el ticket.',
                                            'error'
                                        );
                                    });
                            }
                        });
                    });
                });
            });
        </script>
    @endauth
@endsection


