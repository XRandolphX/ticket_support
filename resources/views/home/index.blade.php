<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Principal</title>
    {{-- Bootstrap Archivo --}}
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    {{-- CSS de la Interfaz Principal --}}
    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet">
    <!-- Incluye el script de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="light-theme">
    @include('layouts.partials.navbarh')

    @guest
        <div class="main-container">
            <div class="info-box">
                <h2>Bienvenido</h2>
                <p>Para ver el contenido <a href="/login" class="btn-theme">Inicia sesión</a></p>
            </div>
        </div>
    @endguest

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                // timer: 3000
            });
        </script>
    @endif

    @auth
        <h1 class="text-center p-3">Crear Ticket de Mantenimiento</h1>
        {{-- Contenido --}}
        <div class="container">
            <h4 class="alert-heading">¡Bienvenido,
                <strong>{{ auth()->user()->first_name ?? auth()->user()->last_name }}</strong>!
            </h4>
            <p>Estás autenticado en la página.</p>
            <h3 class="text-center p-3 display-6">Opciones</h3>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="icon"><i class="fa-solid fa-ticket"></i></div>
                        <h2>Crear Ticket de Soporte Técnico</h2>
                        <p>Aquí puede crear su ticket de soporte técnico de manera fácil y rápida 😊.</p>
                        <button type="button" class="btn-theme" data-bs-toggle="modal"
                            data-bs-target="#modalRegistrar">Crear Ticket</button>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="icon"><i class="fa-solid fa-eye"></i></div>
                        <h2>Consultar estado del Ticket</h2>
                        <p>En este apartado usted puede consultar el estado de su ticket 😊.</p>
                        <a href="{{ url('/seguimiento') }}" class="btn-theme">Consultar</a>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <div class="icon"><i class="fa-solid fa-file-export"></i></div>
                        <h2>Admin</h2>
                        <p>Se concede acceso y permisos para manipular la información.</p>
                        <a href="{{ url('/admin-view') }}" class="btn-theme">Ver Información</a>
                    </div>
                </div>
            </div>
            <!-- Modal Registrar Datos -->
            <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header form-label">
                            <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Ticket</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body">
                                @if (session('status'))
                                    <div class="alert alert-success">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <form action="{{ route('registrar-tickets') }}" method="POST">
                                    @csrf
                                    {{-- Dropdown Prioridad --}}
                                    <div class="mb-3">
                                        <label for="prioridad" class="form-label">Prioridad</label>
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
                                    <div class="mb-3">
                                        <label for="asunto" class="form-label">Asunto</label>
                                        <input type="text" class="form-control" id="asunto" name="subject" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-secondary">Registrar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth


        {{-- Bundle Bootstrap --}}
        <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Botón flotante Principal -->
        <button class="floating-button" onclick="toggleTheme()"><i id="theme-icon"
                class="fa-solid fa-moon"></i></button>

        {{-- Iconos de FontAwesome --}}
        <script src="https://kit.fontawesome.com/10363b534a.js" crossorigin="anonymous"></script>

        <!-- JS de la Interfaz Principal - Cambiar Tema -->
        <script src="assets/js/ticket.js"></script>
</body>

</html>
