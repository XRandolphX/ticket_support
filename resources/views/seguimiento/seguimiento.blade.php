<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Trámite Documentario</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .form-control, .btn-primary {
            border-radius: 0;
        }
        .nav-tabs .nav-link.active {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Consulte su Trámite</h3>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="expediente-tab" data-toggle="tab" href="#expediente" role="tab" aria-controls="expediente" aria-selected="true">Por Expediente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="administrado-tab" data-toggle="tab" href="#administrado" role="tab" aria-controls="administrado" aria-selected="false">Por Administrado</a>
                    </li>
                </ul>
                <div class="tab-content mt-3" id="myTabContent">
                    <div class="tab-pane fade show active" id="expediente" role="tabpanel" aria-labelledby="expediente-tab">
                        <form>
                            <div class="form-group">
                                <label for="year">Año:</label>
                                <select class="form-control" id="year">
                                    <option>2024</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="documentNumber">N° Documento Identidad:</label>
                                <input type="text" class="form-control" id="documentNumber" placeholder="Ingrese DNI o RUC">
                            </div>
                            <button type="submit" class="btn btn-primary">Consultar</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="administrado" role="tabpanel" aria-labelledby="administrado-tab">
                        <!-- Formulario para la pestaña "Por Administrado" -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
