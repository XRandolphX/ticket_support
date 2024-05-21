<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aplicación de Login AUTH</title>
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <!-- Agrega el plugin bootstrap-select (selectpicker) -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css">
    <style>
        body {
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            widows: 400px;
        }
    </style>
</head>

<body>
    <main class="form-container">
        @yield('content')
    </main>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/dropdown_register.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>
</body>

</html>
