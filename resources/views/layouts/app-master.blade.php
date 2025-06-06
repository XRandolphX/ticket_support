<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vista Principal</title>
    {{-- Bootstrap Archivo --}}
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    {{-- CSS de la Interfaz Principal --}}
    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet">
    {{-- Agrega el plugin bootstrap-select (selectpicker) --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    <!-- Incluye el script de SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body class="light-theme">
    @include('layouts.partials.navbar')

    <main class="main-container">
        @yield('content')
    </main>

    <!-- 1) jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    {{-- Bundle Bootstrap --}}
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Iconos de FontAwesome --}}
    <script src="https://kit.fontawesome.com/10363b534a.js" crossorigin="anonymous"></script>



    <!-- Botón flotante Principal -->
    <button class="floating-button" onclick="toggleTheme()"><i id="theme-icon" class="fa-solid fa-moon"></i></button>

    {{--  JS Dropdown Modal --}}
    <script src="{{ url('assets/js/dropdown_register.js') }}"></script>

    {{-- Script plugin bootstrap-select (selectpicker) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>



    <!-- JS de la Interfaz Principal - Cambiar Tema -->
    <script src="assets/js/ticket.js"></script>

    <!-- Sweet Alert 2 -->
    <script src="assets/js/sweet.js"></script>

    <script src="assets/js/qr.js"></script>

    {{-- @stack('scripts') --}}

</body>

</html>
