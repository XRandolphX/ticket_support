{{-- Acá estoy heredando del app-master Principal --}}
@extends('layouts.app-master')

@section('content')
    @auth
        <h1 class="text-center p-3">Crear Ticket de Mantenimiento</h1>
        {{-- Contenido --}}
        <div class="container">
            <h4 class="alert-heading">¡Bienvenido, <strong>{{ auth()->user()->name ?? auth()->user()->username }}</strong>!</h4>
            <p>Estás autenticado en la página.</p>
            {{-- <p><a href="/logout">Logout</a></p> --}}
            <h3 class="text-center p-3">Opciones</h3>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="icon"><i class="fa-solid fa-ticket"></i></div>
                            <h2>Crear Ticket de Soporte Técnico</h2>
                            <p>Aquí puede crear su ticket de sporte técnico de manera fácil y rápida 😊</p>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Crear Ticket</button>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="icon"><i class="fa-solid fa-eye"></i></div>
                            <h2>Consultar estado del Ticket</h2>
                            <p>En este apartado usted puede consultar el estado del ticket. Se cuenta con 4 estados: Recibido,
                                Tramitado, Observado, Archivado 😊</p>
                            <a href="{{ url('/seguimiento') }}" class="btn-theme">Consultar</a>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="info-box">
                            <div class="icon"><i class="fa-solid fa-file-export"></i></div>
                            <h2>Admin</h2>
                            <p>Aquí puede generar los reportes y consultar dato Administrativos</p>
                            <a href="{{ url('/admin-view') }}" class="btn-theme">Ver Información</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Registrar Datos -->
            <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Ticket</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('create-ticket') }}" method="POST">
                                @csrf
                                {{-- Dropdown Prioridad --}}
                                <div class="mb-3">
                                    <div class="col-sm-5">
                                        <div class="row">
                                            <label for="prioridad" class="form-label">Prioridad</label>
                                        </div>
                                        <div class="row">
                                            <select class="selectpicker" data-live-search="true" name="ticket_priority_id">
                                                <option selected disabled data-tokens="Action">Seleccionar Prioridad</option>
                                                @if (isset($datos_prioridad))
                                                    @foreach ($datos_prioridad as $item)
                                                        <option value="{{ $item->id }}">{{ $item->ticket_priority_name }}
                                                        </option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="asunto" class="form-label">Asunto</label>
                                    <input type="text" class="form-control" id="asunto" name="subject" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="descripcion" name="description" rows="3" required></textarea>
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
        </div>

    @endauth

    @guest
        <h1>Home</h1>
        <p>Para ver el contenido <a href="/login">Inicia sesión</a></p>
    @endguest
@endsection
