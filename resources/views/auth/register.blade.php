@extends('layouts.auth-master')
@section('content')
    <form action="/register" method="POST">
        <!-- Agrega campo oculto -->
        @csrf
        @include('layouts.partials.messages')
        <div class="row">
            <div class="col-sm-6">
                <!-- Logo -->
                <img src="assets/img/ugel_logo_nobg.png" alt="Logo de la empresa">
            </div>
            <div class="col-sm-6">
                <h1>Crear una Cuenta</h1>
                <div class="form-floating mb-3">
                    <input type="email" placeholder="name@example.com" name="email" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                    <label for="exampleInputEmail1" class="form-label">Dirección Email</label>
                    <div id="emailHelp" class="form-text">No compartiremos su correo con nadie.</div>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" placeholder="username" name="username" class="form-control"
                        id="exampleInputPassword1">
                    <label for="exampleInputPassword1" class="form-label">Nombre de Usuario</label>
                </div>
                {{-- @foreach ($datos_area as $item)
                    <div class="form-floating mb-3">
                        <!-- Tu dropdown modificado -->
                        <div class="dropdown">
                            <select class="selectpicker" data-live-search="true">
                                <option selected disabled data-tokens="Action">Seleccionar Área</option>
                                <option data-tokens="TRAMITE_DOCUMENTARIO">TRÁMITE DOCUMENTARIO</option>
                                <option data-tokens="IMAGEN_INSTITUCIONAL">IMAGEN INSTITUCIONAL</option>
                                <option data-tokens="UNIDAD_DE_PLANEAMIENTO_Y_DESARROLLO_INSTITUCIONAL">UNIDAD DE
                                    PLANEAMIENTO Y
                                    DESARROLLO INSTITUCIONAL</option>
                                <option data-tokens="UNIDAD_DE_ASESORIA_JURIDICA">UNIDAD DE ASESORIA JURIDICA</option>
                                <option data-tokens="UNIDAD_DE_EDUCACION_BASICA_TECNICO_PRODUCTIVA">UNIDAD DE EDUCACIÓN
                                    BÁSICA
                                    TECNICO PRODUCTIVA</option>
                                <option data-tokens="UNIDAD_DE_ADMINISTRACION">UNIDAD DE ADMINISTRACIÓN</option>
                                <option data-tokens="TESORERIA">TESORERÍA</option>
                                <option data-tokens="CONTABILIDAD">CONTABILIDAD</option>
                                <option data-tokens="INFRAESTRUCTURA">INFRAESTRUCTURA</option>
                                <option data-tokens="PATRIMONIO">PATRIMONIO</option>
                                <option data-tokens="ABASTECIMIENTO">ABASTECIMIENTO</option>
                                <option data-tokens="ALMACEN">ALMACÉN</option>
                                <option data-tokens="PERSONAL">PERSONAL</option>
                                <option data-tokens="REMUNERACIONES">REMUNERACIONES</option>
                                <option data-tokens="INFORMATICA">INFORMÁTICA</option>
                                <option data-tokens="COMISION_DE_PROCESOS_ADMINISTRATIVOS_DOCENTES">COMISION DE PROCESOS
                                    ADMINISTRATIVOS DOCENTES</option>
                                <option data-tokens="ESCALAFON">ESCALAFON</option>
                                <option
                                    data-tokens="PROGRAMA_PRESUPUESTAL_REDUCCION_DE_LA_VULNERABILIDAD_Y_ATENCION_DE_EMERGENCIAS_POR_DESASTRES">
                                    PROGRAMA PRESUPUESTAL REDUCCIÓN DE LA VULNERABILIDAD Y ATENCIÓN DE EMERGENCIAS POR
                                    DESASTRES
                                </option>
                                <option data-tokens="CONSTANCIA_DE_PAGO">CONSTANCIA DE PAGO</option>
                                <option data-tokens="SALA_30%">SALA 30%</option>
                            </select>
                @endforeach --}}
                <div class="form-floating mb-3">
                    <select class="selectpicker" data-live-search="true">
                        <option selected disabled data-tokens="Action">Seleccionar Área</option>
                        @foreach ($datos_area as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="password" placeholder="password" name="password" class="form-control" id="exampleInputPassword1">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" placeholder="password" name="password_confirmation" class="form-control"
                id="exampleInputPassword1">
            <label for="exampleInputPassword1" class="form-label">Confirmar Contraseña</label>
        </div>
        <div class="mb-3">
            <a href="/login">Login</a>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
        </div>
    </form>
@endsection
