@extends('layouts.auth-master')

@section('content')
    <form action="/login" method="POST">
        @csrf
        <h1>Login</h1>
        @include('layouts.partials.messages')
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de Usuario / Email</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">No compartiremos tu dirección de correo electrónico</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <a href="/register">Crear una cuenta</a>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    </form>
@endsection
