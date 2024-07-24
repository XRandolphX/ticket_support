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

    {{-- Formulario de Búsqueda --}}
    <div class="p-4">
        <form action="{{ route('tickets.search') }}" method="GET" class="mb-4">
            <input type="text" name="query" class="form-control" placeholder="Buscar...">
        </form>
    </div>

    {{-- Tabla donde se mostrarán los datos de los Tickets y Usuarios --}}
    <div class="p-4 table-responsive">
        <h1>Seguimiento del ticket</h1>
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
        {{-- <div><a href="/word-export" class="btn btn-primary">Exportar a Word</a></div> --}}
        <div class="mt-2"><a href="/export-qr" class="btn btn-primary">Exportar QR</a></div>

    </div>
@endauth

    <!-- Modal -->
    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">Código QR</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="qrImage" src="" alt="Código QR">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a id="downloadLink" href="#" download="qr_code.png" class="btn btn-primary">Guardar QR</a>
                </div>
            </div>
        </div>
    </div>
@endsection




