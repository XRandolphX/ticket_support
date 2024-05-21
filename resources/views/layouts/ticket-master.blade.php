<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vista de Tickets</title>
    {{-- <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/10363b534a.js" crossorigin="anonymous"></script>

    <link href="{{ asset('assets/css/ticket.css') }}" rel="stylesheet">

</head>

<body class="light-theme">
    <main class="container">
        {{-- Directiva para reservar espacio al contenido de la vista Ticket --}}
        @yield('content')
    </main>
    {{-- <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Botón flotante -->
    <button class="floating-button" onclick="toggleTheme()"><i id="theme-icon" class="fa-solid fa-moon"></i></button>
    <!-- JS de la Interfaz Ticket -->
    <script src="assets/js/ticket.js"></script>
</body>

</html>
