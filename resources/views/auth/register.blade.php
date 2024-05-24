@extends('layouts.auth-master')

@section('content')
    <form action="/register" method="POST">
        @csrf
        @include('layouts.partials.messages')

        <div class="row">
            <div class="col-sm-6">
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

                <div class="form-floating mb-3">
                    <select class="selectpicker" data-live-search="true">
                        <option selected disabled data-tokens="Action">Seleccionar Área</option>
                        @foreach ($datos_area as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" placeholder="password" name="password" class="form-control"
                        id="exampleInputPassword1">
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
