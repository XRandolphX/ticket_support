{{-- En esta vista estoy heredando la plantilla de diseño ticket-master --}}
@extends('layouts.ticket-master')

@section('content')
    <h1 class="text-center p-3">Generar ticket</h1>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="info-box">
                    <div class="icon"><i class="fa-solid fa-ticket"></i></div>
                    <h2>Crear Ticket de Mantenimiento</h2>
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
                        <div class="mb-3">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="prioridadDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Seleccionar Prioridad
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="prioridadDropdown">
                                    <li><a class="dropdown-item" data-value="Emergencia" href="#">Emergencia</a></li>
                                    <li><a class="dropdown-item" data-value="Alta" href="#">Alta</a></li>
                                    <li><a class="dropdown-item" data-value="Normal" href="#">Normal</a></li>
                                    <li><a class="dropdown-item" data-value="Baja" href="#">Baja</a></li>
                                </ul>
                                <input type="hidden" name="prioridad" id="prioridad-input">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="txtasunto" required>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="txtdescripcion" rows="3" required></textarea>
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
@endsection
